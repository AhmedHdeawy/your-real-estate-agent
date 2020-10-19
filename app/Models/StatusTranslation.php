<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusTranslation extends Model
{
    /**
     * table
     */
    protected $table = 'status_translations';

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['status_id', 'locale', 'name'];


    /**
     * Info that belongs To
     */
    public function type()
    {
        return $this->belongsTo('App\Models\Status', 'status_id', 'id');
    }
}
