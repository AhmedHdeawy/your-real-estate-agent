<?php

namespace App;

use Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements CanResetPassword
{
    use Notifiable;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name_for_avatar'];

    protected $guarded = ['status'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'phone', 'password', 'gender', 'avatar', 'provider_name', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'provider_name', 'provider_id'
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
     * Get the the name for avatar.
     */
    public function getNameForAvatarAttribute()
    {
        return $this->nameForAvatar();
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

    public function friends()
    {
        return $this->firendsOfMine->merge($this->firendOf);
    }

    public function firendsOfMine()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
    }

    public function firendOf()
    {
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id');
    }

    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages($receiver_id)
    {
        return $this->hasMany('App\Models\Message', 'sender_id', 'id')->where('receiver_id', $receiver_id);
    }

    public function nameForAvatar()
    {
        $name = explode(' ', $this->name);  // Example:  'ahmed mohamed ali taha'
        $shortForvatar = implode(' ', [$name[0], $name[1] ?? null]);    // 'ahmed mohamed'
        return $shortForvatar;
    }

}
