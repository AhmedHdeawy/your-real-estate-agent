<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * Get the owning imageable model.
     */
    public function mediable()
    {
        return $this->morphTo();
    }
}
