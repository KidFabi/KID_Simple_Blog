<?php

namespace App\Events\Post;

use App\Models\Post;

class PostWasRejectedEvent
{
    /**
     * @var \App\Models\Post
     */
    public $post;

    /**
     * Create a new event instance.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}
