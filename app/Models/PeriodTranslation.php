<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodTranslation extends Model
{
    /**
     * table
     */
    protected $table = 'period_translations';

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['period_id', 'locale', 'name'];


    /**
     * Info that belongs To
     */
    public function period()
    {
        return $this->belongsTo('App\Models\Period', 'period_id', 'id');
    }
}
