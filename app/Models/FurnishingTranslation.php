<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FurnishingTranslation extends Model
{
    /**
     * table
     */
    protected $table = 'furnishing_translations';
    protected $primaryKey = 'furnishing_trans_id';

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['furnishing_id', 'locale', 'name'];


    /**
     * Info that belongs To
     */
    public function furnishing()
    {
        return $this->belongsTo('App\Models\Furnishing', 'furnishing_id', 'id');
    }
}
