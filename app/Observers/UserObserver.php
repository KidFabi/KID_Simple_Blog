<?php

namespace App\Observers;

use App\Models\User;
use App\Traits\ImageTrait;

class UserObserver
{
    use ImageTrait;

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        if ($user->avatar !== "default.png") {
            $this->deleteImage(User::IMAGE_FOLDER, $user, 'avatar', true);
        }
    }
}
