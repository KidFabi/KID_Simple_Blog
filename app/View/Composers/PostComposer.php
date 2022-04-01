<?php

namespace App\View\Composers;

use App\Models\Post;
use Illuminate\View\View;

class PostComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return mixed
     */
    public function compose(View $view)
    {
        $posts = Post::with(['categories:id,name', 'author:id,username,avatar'])
            ->select(['slug', 'published_at', 'author_id', 'cover', 'title', 'subhead', 'cover'])
            ->published()
            ->orderBy('published_at', 'DESC')
            ->take(3)
            ->get();

        $view->with('posts', $posts);
    }
}