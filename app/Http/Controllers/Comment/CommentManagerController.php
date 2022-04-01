<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentManagerController extends Controller
{
    /**
     * Display all comments.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Comment::class);

        $comments = Comment::with('user:id,username')
            ->select(['id', 'created_at', 'user_id', 'post_id', 'comment', 'is_hidden'])
            ->latest()
            ->paginate(20);

        return view('web.manager.comments.index', compact('comments'));
    }
}
