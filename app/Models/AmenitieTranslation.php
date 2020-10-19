<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmenitieTranslation extends Model
{
    /**
     * table
     */
    protected $table = 'amenitie_translations';

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['amenitie_id', 'locale', 'name'];


    /**
     * Info that belongs To
     */
    public function amenitie()
    {
        return $this->belongsTo('App\Models\Amenitie', 'amenitie_id', 'id');
    }
}
