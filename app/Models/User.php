<?php

namespace DEMHub\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_name', 'user_email', 'user_password', 'user_avatar_id' , 'updated_at', 'created_at', 'first_name', 'last_name', 'job_title', 'org_agency', 'phone_number', 'specialization'];

    protected $guarded = ['user_password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function avatar(){
      return $this->hasOne('Avatar', 'avatar_user_id');
    }

    public function files() {
      return $this->hasMany('Files', 'user_id');
    }

    public function likes() {
      return $this->hasMany('Likes', 'user_id');
    }

    public function getFollowFeed() {
      return $this->hasMany('Followfeed', 'user_id')
                  ->where('user_id', '=', Auth::user()->id)
                  ->where('hidden', '=', false);
    }
}
