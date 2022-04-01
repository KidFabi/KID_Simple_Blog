<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use App\Services\UserService;

class UserAccountController extends Controller
{
    /**
     * Display the account of authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = auth()->user();

        return view('web.account.show', compact('user'));
    }

    /**
     * Update the account of authenticated user.
     *
     * @param  \App\Http\Requests\User\UserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, UserService $userService)
    {
        try {
            $userService->updateUser($request);
        } catch (\Throwable $th) {
            return redirect()
                ->route('account.show')
                ->with('fail', __('Your account could not be updated. Please, try again later.'))
                ->withInput($request->validated());
        }

        return redirect()
            ->route('account.show')
            ->with('success', __('Your account has been updated successfully.'));
    }

    /**
     * Delete the account of authenticated user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        $user = User::find(auth()->user()->id);

        auth()->logout();

        if (!$user->delete()) {
            return redirect()
                ->route('account.show')
                ->with('fail', __('Your account could not be deleted. Please, try again!'));
        }

        /**
         * Delete user's avatar in \App\Observers\UserObserver::deleted.
        */

        return redirect()
            ->route('login')
            ->with('success', __('Your account has been deleted successfully.'));
    }
}
