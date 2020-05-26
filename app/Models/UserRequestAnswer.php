<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRequestAnswer extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_request_answers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'answer', 'group_requests_id'
    ];


    public function request()
    {
        return $this->belongsTo('App\Models\GroupRequest', 'group_requests_id', 'id');
    }
}
