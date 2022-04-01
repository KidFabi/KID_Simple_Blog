<?php

namespace App\Observers;

use App\Models\Post;
use App\Traits\ImageTrait;

class PostObserver
{
    use ImageTrait;

    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        if ($post->isDirty('cover')) {
            return $this->deleteImage(Post::IMAGE_FOLDER, $post, 'cover');
        }
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        return $this->deleteImage(Post::IMAGE_FOLDER, $post, 'cover');
    }
}
