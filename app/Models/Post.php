<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    /**
     * The attributes that are not mass assigned.
     *
     * @var array
     */
    protected $guarded = ['has_media', 'status'];

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
    protected $with = ['comments', 'user', 'media'];

    /**
     * The relationship counts that should be eager loaded on every query.
     *
     * @var array
     */
    protected $withCount = ['likes', 'comments'];



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
