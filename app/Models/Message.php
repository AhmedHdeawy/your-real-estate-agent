<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text', 'sender_id', 'receiver_id'
    ];

    /**
     * User who owner the Post
     */
    public function sender()
    {
        return $this->belongsTo('App\User', 'sender_id', 'id');
    }

    /**
     * Group that has the Post
     */
    public function receiver()
    {
        return $this->belongsTo('App\User', 'receiver_id', 'id');
    }
}
