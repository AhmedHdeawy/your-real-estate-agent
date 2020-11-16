<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Blog extends Model implements TranslatableContract
{
    use Translatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blogs';

    /**
     * translated attributes
     */
    public $translatedAttributes = ['title', 'content'];

    /**
     * fillable attributes
     */
    protected $fillable = ['status', 'image'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

    public function setImageAttribute($file)
    {
        if ($file) {

            if (is_string($file)) {
                $this->attributes['image'] = $file;
            } else {

                $name =  $file->getClientOriginalName();
                $name = uniqid('Property_Club_') . time() . '_' . $name;
                $path = 'blogs/';
                // Store Image
                Storage::disk('public')->putFileAs($path, $file, $name);

                $this->attributes['image'] = $path . $name;
            }
        }
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
