<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	protected $fillable = array('user_name', 'user_email', 'user_password', 'user_avatar_id' , 'updated_at', 'created_at');

	protected $guarded = ['user_password'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function avatar(){
		return $this->hasOne('Avatar', 'avatar_user_id');
	}


	public function files() {
		return $this->hasMany('Files', 'user_id');
	}

	public function likes() {
		return $this->hasMany('Likes', 'user_id');
	}

	public function getFollowFeed(){
		return $this->hasMany('Followfeed', 'user_id')
					->where('user_id', '=', Auth::user()->id)
					->where('hidden', '=', false);	
	}

}
