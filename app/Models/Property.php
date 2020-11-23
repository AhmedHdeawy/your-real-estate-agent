<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

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
    public $translatedAttributes = ['title'];


    /**
     * fillable attributes
     */
    protected $fillable = [
        'price',
        'lat',
        'lng',
        'address',
        'status',
        'agent_name',
        'agent_phone',
        'agent_email',
        'no_of_rooms',
        'no_of_maidrooms',
        'no_of_bathrooms',
        'height',
        'width',
        'description',
        'user_id',
        'category_id',
        'type_id',
        'period_id',
        'furnishing_id',
        'completing_id'
    ];

    public function getPriceAttribute($value)
    {
        $price = explode('.', $value);
        if ($price[1] == 0) {
            return $price[0];
        }
        return $price;
    }

    public function amenities()
    {
        return $this->belongsToMany('App\Models\Amenitie', 'property_amenities', 'property_id', 'amenitie_id');
    }

    public function favorites()
    {
        return $this->belongsToMany('App\Models\User', 'favorites', 'property_id', 'user_id');
    }

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
        return $this->hasMany('App\Models\PropertyImage', 'property_id', 'id');
    }

    public function threeImages()
    {
        return $this->hasMany('App\Models\PropertyImage', 'property_id', 'id')->offset(3)->limit();
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
