<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    use ImageTrait;

    /**
     * Update the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function updateUser(Request $request, $user = null)
    {
        if (!isset($user)) {
            $user = auth()->user();
        }

        $data = $request->validated();

        if ($request->has('delete_avatar') && $user->avatar !== "default.png") {
            $this->deleteImage(User::IMAGE_FOLDER, $user, 'avatar', true);
        }

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->storeImage($request, 'avatar', User::IMAGE_FOLDER);

            if ($user->avatar !== "default.png") {
                $this->deleteImage(User::IMAGE_FOLDER, $user, 'avatar', true);
            }
        }

        if ($request->has('password')) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return true;
    }

    /**
     * Generate a copy of user's data.
     *
     * @return string
     */
    public function generateDataCopy()
    {
        $user = auth()->user();
        $copiesPath = 'public/uploads/' . User::DATA_COPIES_FOLDER . '/';

        $data = [
            'data_copy_generated_at' => now(),
            'timezone' => config('app.timezone'),
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'created_at' => date('Y-m-d\TH:i:s.u\Z', strtotime($user->getRawOriginal('created_at'))),
                    'updated_at' => $user->updated_at,
                    'email' => $user->email,
                    'role' => $user->role,
                    'username' => $user->username,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'birth_date' => $user->birth_date,
                    'notifications' => $user->notifications,
                    'post_comments' => $user->post_comments,
                ],
            ],
        ];

        foreach ($user->comments as $comment) {
            $c['created_at'] = date('Y-m-d\TH:i:s.u\Z', strtotime($comment->getRawOriginal('created_at')));
            $c['updated_at'] = $comment->updated_at;
            $c['post_id'] = $comment->post_id;
            $c['comment'] = $comment->comment;
            $data['data']['user_comments'][] = $c;
        }

        $fileName = $user->id.time().'.json';

        Storage::put($copiesPath.$fileName, json_encode($data));

        return 'app/'.$copiesPath.$fileName;
    }

    /**
     * Get the list of users with enabled notifications.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getSubscribers()
    {
        return User::select('email')
            ->where('notifications', true)
            ->get();
    }

    /**
     * Create starter accounts.
     *
     * @return bool
     */
    public function createStarterAccounts()
    {
        $accounts = [
            [
                'email' => 'administrator@kidsimple.blog',
                'role' => 1,
                'username' => 'Administrator',
                'last_name' => 'Administrator',
            ],
            [
                'email' => 'editor@kidsimple.blog',
                'role' => 2,
                'username' => 'Editor',
                'last_name' => 'Editor',
            ],
            [
                'email' => 'author@kidsimple.blog',
                'role' => 3,
                'username' => 'Author',
                'last_name' => 'Author',
            ],
            [
                'email' => 'user@kidsimple.blog',
                'role' => 4,
                'username' => 'User',
                'last_name' => 'User',
            ]
        ];

        foreach ($accounts as $account) {
            User::firstOrCreate([
                'email' => $account['email'],
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $account['role'],
                'username' => $account['username'],
                'first_name' => 'Blog',
                'last_name' => $account['last_name'],
                'birth_date' => '2000-03-31',
            ]);
        }

        return true;
    }
}
