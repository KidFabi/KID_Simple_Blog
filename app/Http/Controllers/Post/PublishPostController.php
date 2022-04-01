<?php

namespace App\Http\Controllers\Post;

use App\Events\Post\PostWasPublishedEvent;
use App\Http\Controllers\Controller;
use App\Models\Post;

class PublishPostController extends Controller
{
    /**
     * Publish the blog post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(Post $post)
    {
        $this->authorize('publishReject', $post);

        $post->update([
            'published_at' => now(),
            'visibility' => 'Published',
        ]);

        event(new PostWasPublishedEvent($post));

        return redirect()
            ->route('manager.posts.show', $post->id)
            ->with('success', __('Post has been published successfully.'));
    }
}
