<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserManagerRequest;
use App\Models\User;
use App\Services\UserService;

class UserManagerController extends Controller
{
    /**
     * Display the user manager page.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::select(['id', 'created_at', 'username', 'email', 'first_name', 'last_name', 'role'])
            ->orderBy('role', 'ASC')
            ->latest()
            ->paginate(10);

        return view('web.manager.users.index', compact('users'));
    }

    /**
     * Display the specified user profile.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(User $user)
    {
        $this->authorize('view', User::class);

        return view('web.manager.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('web.manager.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \App\Http\Requests\User\UserManagerRequest  $request
     * @param  \App\Models\User  $user
     * @param  \App\Services\UserService  $userService
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UserManagerRequest $request, User $user, UserService $userService)
    {
        $this->authorize('update', $user);

        try {
            $userService->updateUser($request, $user);
        } catch (\Throwable $th) {
            return redirect()
                ->route('manager.users.edit', $user->id)
                ->with('fail', __('The account could not be updated. Please, try again later.'))
                ->withInput($request->validated());
        }

        return redirect()
            ->route('manager.users.edit', $user->id)
            ->with('success', __('The account has been updated successfully.'));
    }
}
