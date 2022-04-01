<?php

namespace App\Http\Controllers\Post;

use App\Events\Post\PostWasRejectedEvent;
use App\Http\Controllers\Controller;
use App\Models\Post;

class RejectPostController extends Controller
{
    /**
     * Reject the blog post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(Post $post)
    {
        $this->authorize('publishReject', $post);

        $post->update([
            'visibility' => 'Rejected',
        ]);

        event(new PostWasRejectedEvent($post));

        return redirect()
            ->route('manager.posts.show', $post->id)
            ->with('success', __('Post has been rejected successfully.'));
    }
}
