<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the posts manager page.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->isAdministrator()
            || $user->isEditor()
            || $user->isAuthor();
    }

    /**
     * Determine whether the user can view the post preview and number of views.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Post $post)
    {
        return ($user->id === $post->author_id && $user->isAuthor())
            || $user->isAdministrator()
            || $user->isEditor();
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isAdministrator()
            || $user->isEditor()
            || $user->isAuthor();
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Post $post)
    {
        return ($user->id === $post->author_id && $user->isAuthor() && !$post->isPublished())
            || $user->isAdministrator()
            || $user->isEditor();
    }

    /**
     * Determine whether the user can delete all posts.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->isAdministrator()
            || $user->isEditor();
    }

    /**
     * Determine whether the user can publish or reject the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function publishReject(User $user, Post $post)
    {
        return !$post->isPublished()
            && $post->visibility === "Awaiting Approval"
            && ($user->isAdministrator() || $user->isEditor());
    }
}
