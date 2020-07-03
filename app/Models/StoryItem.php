<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class StoryItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'story_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'length', 'type', 'text', 'media', 'story_id'
    ];

    public function getUpdatedAtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', '2018-01-30 07:11:21', 'America/Chicago')->timestamp;
    }


    /**
     * User who owner the Post
     */
    public function story()
    {
        return $this->belongsTo('App\Models\Story', 'story_id', 'id');
    }

}
