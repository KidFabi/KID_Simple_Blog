<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment',
        'is_hidden',
        'user_id',
    ];

    /**
     * The user that belongs to the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)
            ->select(['id', 'username', 'avatar']);
    }

    /**
     * The post that belongs to the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
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
}
