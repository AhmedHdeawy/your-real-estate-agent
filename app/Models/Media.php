<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

    /**
     * Media Types
     * ('image','video','audio','file')
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title', 'type', 'mediable'
    ];

    /**
     * Get the owning imageable model.
     */
    public function mediable()
    {
        return $this->morphTo();
    }
}
