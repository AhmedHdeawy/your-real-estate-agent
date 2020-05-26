<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text', 'user_id', 'post_id'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['replies', 'user'];

    /**
     * The relationship counts that should be eager loaded on every query.
     *
     * @var array
     */
    protected $withCount = ['likes'];


    /**
     * User who owner the Post
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Post that has the Post
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id', 'id');
    }

    /**
     * comments that belongs to this post
     */
    public function replies()
    {
        return $this->hasMany('App\Models\Reply', 'comment_id', 'id');
    }

    /**
     * likes that belongs to this post
     */
    public function likes()
    {
        return $this->hasMany('App\Models\Like', 'post_id', 'id');
    }
}
