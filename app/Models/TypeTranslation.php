<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeTranslation extends Model
{
    /**
     * table
     */
    protected $table = 'type_translations';

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['type_id', 'locale', 'name'];


    /**
     * Info that belongs To
     */
    public function type()
    {
        return $this->belongsTo('App\Models\Type', 'type_id', 'id');
    }
}
