<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class ResourceEntry extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	protected $fillable = array('id', 'title', 'entry','country', 'region');

	// protected $guarded = ['user_password'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'resource_entries';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = array('password', 'remember_token');

	


	// public function files() {
// 		return $this->hasMany('Files', 'user_id');
// 	}
//
// 	public function likes() {
// 		return $this->hasMany('Likes', 'user_id');
// 	}
//
// 	public function getFollowFeed(){
// 		return $this->hasMany('Followfeed', 'user_id')
// 					->where('user_id', '=', Auth::user()->id)
// 					->where('hidden', '=', false);
// 	}

}
