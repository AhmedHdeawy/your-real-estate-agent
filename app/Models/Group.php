<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'description', 'user_id'
    ];


    /**
     * User who owner the Group
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\GroupQuestion', 'group_id', 'id');
    }


    public function requests()
    {
        return $this->hasMany('App\Models\GroupRequest', 'group_id', 'id');
    }

}
