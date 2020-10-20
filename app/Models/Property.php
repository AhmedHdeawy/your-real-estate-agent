<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Property extends Model implements TranslatableContract
{
    use Translatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'properties';

    /**
     * translated attributes
     */
    public $translatedAttributes = ['name'];

    /**
     * fillable attributes
     */
    protected $fillable = [
        'price',
        'lat',
        'long',
        'address',
        'status',
        'agent_phone',
        'agent_email',
        'agent_name',
        'no_of_rooms',
        'no_of_maidrooms',
        'no_of_bathrooms',
        'area',
        'description',
        'user_id',
        'category_id',
        'type_id',
        'period_id',
        'furnishing_id',
        'completing_id'
    ];

    public function agent()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Type', 'type_id');
    }

    public function period()
    {
        return $this->belongsTo('App\Models\Period', 'period_id');
    }

    public function furnishing()
    {
        return $this->belongsTo('App\Models\Furnishing', 'furnishing_id');
    }

    public function completing()
    {
        return $this->belongsTo('App\Models\Completing', 'completing_id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\PropertyImage');
    }


    /**
     * Scope a query to get active data.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', '1')->orderBy('id');
    }
}
