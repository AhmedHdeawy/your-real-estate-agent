<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['is_like'];

    /**
     * The attributes that are not mass assigned.
     *
     * @var array
     */
    protected $guarded = ['unique_id', 'has_media', 'status'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text', 'user_id', 'group_id'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['comments', 'user', 'media', 'group'];

    /**
     * The relationship counts that should be eager loaded on every query.
     *
     * @var array
     */
    protected $withCount = ['likes', 'comments'];

    /**
     * Get the the user that like the post.
     */
    public function getIsLikeAttribute()
    {

        $authId = Auth::id();

        $isLike = in_array($authId, $this->likes()->get()->pluck('user_id')->toArray());

        return $isLike ? true : false;
    }


    /**
     * User who owner the Post
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Group that has the Post
     */
    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id', 'id');
    }

    /**
     * comments that belongs to this post
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id', 'id');
    }

    /**
     * likes that belongs to this post
     */
    public function likes()
    {
        return $this->hasMany('App\Models\Like', 'post_id', 'id');
    }


    /**
     * Get all of the post's media.
     */
    public function media()
    {
        return $this->morphMany('App\Models\Media', 'mediable');
    }

}
