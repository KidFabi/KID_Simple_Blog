<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     *
     * @param  \App\Http\Requests\Comment\CommentRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CommentRequest $request, Post $post)
    {
        $this->authorize('create', Comment::class);

        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;

        $post->comments()->create($data);

        return redirect()
            ->route('posts.show', $post->slug)
            ->with('success', __('The comment has been submitted successfully.'));
    }

    /**
     * Show the form for editing the specified comment.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);

        return view('web.comments.edit', compact('comment'));
    }

    /**
     * Update the specified comment in storage.
     *
     * @param  \App\Http\Requests\Comment\CommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->update($request->validated());

        return back()
            ->with('success', __('The comment has been updated'));
    }

    /**
     * Remove the specified comment from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $deleted = $comment->delete();

        if (!$deleted) {
            return back()
                ->with('fail', __('The comment could not be deleted. Please, try again.'));
        }

        return back()
            ->with('success', __('The comment has been deleted successfully.'));
    }
}
