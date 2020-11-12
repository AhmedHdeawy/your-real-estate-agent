<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    /**
     * table
     */
    protected $table = 'property_images';

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['property_id', 'name'];


    /**
     * Info that belongs To
     */
    public function property()
    {
        return $this->belongsTo('App\Models\Property', 'property_id', 'id');
    }
}
