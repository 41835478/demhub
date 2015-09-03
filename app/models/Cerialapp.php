<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Cerialapp extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	protected $fillable = array('app_name', 'app_desc', 'app_user_id', 'app_public','app_url', 'app_configured', 'updated_at', 'created_at');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'apps';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	public function settings() {
		return $this->hasMany('Cerialappsettings');
	}

	public function likes(){
		return $this->hasMany('likes', 'apps_id');
	}

	public function favourites(){
		return $this->hasMany('favourites', 'apps_id');
	}

	public function user(){
		return $this->belongsTo('User', 'app_user_id');
	}


}
