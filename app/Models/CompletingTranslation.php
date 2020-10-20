<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompletingTranslation extends Model
{
    /**
     * table
     */
    protected $table = 'completing_translations';

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['completing_id', 'locale', 'name'];


    /**
     * Info that belongs To
     */
    public function type()
    {
        return $this->belongsTo('App\Models\Completing', 'completing_id', 'id');
    }
}
