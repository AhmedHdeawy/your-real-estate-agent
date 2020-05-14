<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title', 'mediable'
    ];

    /**
     * Get the owning imageable model.
     */
    public function mediable()
    {
        return $this->morphTo();
    }
}
