<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The posts that belong to the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
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
