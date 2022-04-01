<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Value in database for Administrator role.
     */
    const ADMINISTRATOR = 1;

    /**
     * Value in database for Editor role.
     */
    const EDITOR = 2;

    /**
     * Value in database for Author role.
     */
    const AUTHOR = 3;

    /**
     * Value in database User role.
     */
    const USER = 4;

    /**
     * Name of the folder that contains user avatars.
     *
     */
    const IMAGE_FOLDER = 'users/avatars';

    /**
     * Name of the folder that contains user data copies.
     */
    const DATA_COPIES_FOLDER = 'users/data_copies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'role',
        'username',
        'avatar',
        'first_name',
        'last_name',
        'birth_date',
        'notifications',
        'post_comments',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The posts that belong to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id')
            ->select(['id', 'created_at', 'title', 'visibility']);
    }

    /**
     * The comments that belong to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)
            ->select(['id', 'created_at', 'comment', 'post_id', 'is_hidden']);
    }

    /**
     * Change the display format of creation date.
     *
     * @param  string  $value
     * @return \Carbon\Carbon
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)
            ->format(config('kidblog.default_datetime_format'));
    }

    /**
     * Check if user is an administrator.
     *
     * @return boolean
     */
    public function isAdministrator()
    {
        return $this->role === self::ADMINISTRATOR;
    }

    /**
     * Check if user is an editor.
     *
     * @return boolean
     */
    public function isEditor()
    {
        return $this->role === self::EDITOR;
    }

    /**
     * Check if user is an administrator.
     *
     * @return boolean
     */
    public function isAuthor()
    {
        return $this->role === self::AUTHOR;
    }

    /**
     * Display the avatar of the user.
     *
     * @return string
     */
    public function avatar()
    {
        if (empty($this->avatar)) {
            return asset('images/user/avatar.png');
        }

        return asset('storage/uploads/'.self::IMAGE_FOLDER.'/'.$this->avatar);
    }
}
