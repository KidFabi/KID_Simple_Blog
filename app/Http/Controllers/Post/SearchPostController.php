<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchPostController extends Controller
{
    /**
     * Search for a blog post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $term = $request->search;

        $posts = Post::query()
            ->select(['id', 'title', 'subhead', 'cover', 'slug'])
            ->published()
            ->orderBy('published_at', 'DESC');

        if (!empty($term)) {
            $posts->where('title', 'like', "%{$term}%")
                ->orWhere('subhead', 'like', "%{$term}%")
                ->orWhere('content', 'like', "%{$term}%");
        }

        $posts = $posts->paginate(10);

        return view('web.posts.search', compact('posts', 'term'));
    }
}
