<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupQuestion extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'answer', 'group_id'
    ];


    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id', 'id');
    }
}
