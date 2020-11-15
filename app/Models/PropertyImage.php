<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

    /**
     * fillable attributes
     */
    protected $fillable = ['property_id', 'image'];



    /**
     * Info that belongs To
     */
    public function property()
    {
        return $this->belongsTo('App\Models\Property', 'property_id', 'id');
    }

    /**
     * Get image url for the category image.
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image)
            return null;

        return Storage::disk('public')->url($this->image);
    }
}
