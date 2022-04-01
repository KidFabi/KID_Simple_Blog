<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostService;

class PostController extends Controller
{
    /**
     * Display all published blog posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::select(['slug', 'title', 'subhead', 'cover'])
            ->published()
            ->orderBy('published_at', 'DESC')
            ->paginate(5);

        return view('web.posts.index', compact('posts'));
    }

    /**
     * Display the specified published blog post.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Services\PostService  $postService
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, PostService $postService)
    {
        // Fake 404 if user is trying to access an unpublished post.
        if (!$post->isPublished()) {
            abort(404);
        }

        $postService->incrementViews($post);

        $post = $post->load('comments.user');

        return view('web.posts.show', compact('post'));
    }
}
