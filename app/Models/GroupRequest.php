<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'group_id'
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id', 'id');
    }

    public function userAnswers()
    {
        return $this->hasMany('App\Models\UserRequestAnswer', 'group_requests_id', 'id');
    }
}
