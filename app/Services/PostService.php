<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Cookie;

class PostService
{
    /**
     * Increment views of the blog post.
     *
     * @param  \App\Models\Post  $post
     * @return bool|\Illuminate\Database\Query\Builder
     */
    public function incrementViews(Post $post)
    {
        if (Cookie::has('post_'.$post->id)) {
            return true;
        }

        Cookie::queue(Cookie::make('post_'.$post->id, 'post_viewed', 60*24));

        return $post->increment('views');
    }
}
