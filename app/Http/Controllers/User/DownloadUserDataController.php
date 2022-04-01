<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\UserService;

class DownloadUserDataController extends Controller
{
    /**
     * Generate a data copy of the authenticated user.
     *
     * @param  \App\Services\UserService  $userService
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UserService $userService)
    {
        try {
            $path = $userService->generateDataCopy();
        } catch (\Throwable $th) {
            return redirect()
                ->route('account.show')
                ->with('fail', __('The data copy could not be generated. Please, try again!'));
        }

        return response()
            ->download(storage_path($path))
            ->deleteFileAfterSend(false);
    }
}
