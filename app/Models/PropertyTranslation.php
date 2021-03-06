<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyTranslation extends Model
{
    /**
     * table
     */
    protected $table = 'property_translations';
    protected $primaryKey = 'property_trans_id';

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['property_id', 'locale', 'title', 'desc'];


    /**
     * Info that belongs To
     */
    public function property()
    {
        return $this->belongsTo('App\Models\Property', 'property_id', 'id');
    }
}
