<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    /**
     * table
     */
    protected $table = 'blog_translations';
    protected $primaryKey = 'blog_trans_id';

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['blog_id', 'locale', 'title', 'content'];


    /**
     * Info that belongs To
     */
    public function blog()
    {
        return $this->belongsTo('App\Models\Blog', 'blog_id', 'id');
    }
}
