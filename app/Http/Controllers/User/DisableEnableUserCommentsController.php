<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class DisableEnableUserCommentsController extends Controller
{
    /**
     * Disable or enable comment ability for the user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(User $user)
    {
        $this->authorize('disableEnableComments', User::class);

        $user->post_comments = !$user->post_comments;

        $user->save();

        return redirect()
            ->route('manager.users.show', $user->id)
            ->with('success', __('Comment ability for this user has been changed successfully.'));
    }
}
