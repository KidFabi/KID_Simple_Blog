<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Mews\Purifier\Casts\CleanHtml;

class Post extends Model
{
    use HasFactory;

    /**
     * Name of the folder that contains post covers.
     */
    const IMAGE_FOLDER = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'published_at',
        'visibility',
        'cover',
        'title',
        'subhead',
        'content',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime',
        'content' => CleanHtml::class,
    ];

    /**
     * The author that belongs to the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The categories that belong to the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * The comments that belong to the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)
            ->latest();
    }

    /**
     * Create a slug from the post title.
     *
     * @param  string  $value
     * @return string
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        return $this->attributes['slug'] = Str::slug($value);
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
     * Change the display format of publication date.
     *
     * @param  string  $value
     * @return \Carbon\Carbon
     */
    public function getPublishedAtAttribute($value)
    {
        if (!empty($value)) {
            return Carbon::parse($value)
                ->format(config('kidblog.default_datetime_format'));
        }
    }

    /**
     * Scope a query to include only published posts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished(Builder $query)
    {
        return $query->whereNotNull('published_at')
            ->where('visibility', 'Published');
    }

    /**
     * Scope a query to include only rejected posts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRejected(Builder $query)
    {
        return $query->where('visibility', 'Rejected');
    }

    /**
     * Display the cover of the post.
     *
     * @return string
     */
    public function cover()
    {
        if (empty($this->cover)) {
            return config('kidblog.default_post_cover');
        }

        return asset('storage/uploads/'.self::IMAGE_FOLDER.'/'.$this->cover);
    }

    /**
     * Shorten the post title.
     *
     * @return string
     */
    public function shortTitle()
    {
        return Str::limit($this->title, 50);
    }

    /**
     * Shorten the post subhead.
     *
     * @return string
     */
    public function shortSubhead()
    {
        return Str::limit($this->subhead, 100);
    }

    /**
     * Check if the post is published.
     *
     * @return boolean
     */
    public function isPublished()
    {
        return $this->published_at !== null
            && $this->visibility === "Published";
    }
}
