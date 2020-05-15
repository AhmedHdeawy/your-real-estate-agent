<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $guarded = ['status', 'unique_name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'image', 'user_id',
    ];

    /**
     * Set Group image
     *  @param string $file
     */
    public function setImageAttribute($file)
    {

        if ($file) {

            if (is_string($file)) {
                $this->attributes['image'] = $file;
            } else {

                $name =  $file->getClientOriginalName();
                $name = time() . '_' . $name;

                Image::make($file)->save('uploads/groups/' . $name);

                $this->attributes['image'] = $name;
            }
        }
    }

    public function questions()
    {
        return $this->hasMany('App\Models\GroupQuestion', 'group_id', 'id');
    }

    public function requests()
    {
        return $this->hasMany('App\Models\GroupRequest', 'group_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'group_members', 'group_id', 'user_id');
    }

    public function members()
    {
        return $this->belongsToMany('App\User', 'group_members', 'group_id', 'user_id')->wherePivot('role', 'member');
    }

    public function owners()
    {
        return $this->belongsToMany('App\User', 'group_members', 'group_id', 'user_id')->wherePivot('role', 'owner');
    }

    public function admins()
    {
        return $this->belongsToMany('App\User', 'group_members', 'group_id', 'user_id')->wherePivot('role', 'admin');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'group_id', 'id');
    }
}
