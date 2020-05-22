<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'post_id'
    ];

    /**
     * Post that has this Like
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id', 'id');
    }

    /**
     * User who owner the Post
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
