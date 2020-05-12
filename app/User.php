<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Image;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['status'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'age', 'email', 'phone', 'password', 'gender', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Set the client's password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        if($value) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    /**
     * Set Client logo
     *  @param string $file
     */
    public function setAvatarAttribute($file)
    {

    	if ($file) {

	        if (is_string($file)) {
	          $this->attributes['avatar'] = $file;

	        } else {

	          $name =  $file->getClientOriginalName();
	          $name = time() . '_' . $name;

	          Image::make($file)->save('uploads/users/'. $name);

	          $this->attributes['avatar'] = $name;
	        }
    	}
    }


    /**
     * Scope a query to fetch Active data only.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }


    public function myGroups()
    {
        return $this->hasMany('App\Models\Group', 'user_id', 'id');
    }

    public function inGroups()
    {
        return $this->belongsToMany('App\Models\Group', 'group_members', 'user_id', 'group_id');
    }

    public function requests()
    {
        return $this->hasMany('App\Models\GroupRequest', 'user_id', 'id');
    }

}
