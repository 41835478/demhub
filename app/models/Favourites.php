<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Favourites extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	protected $fillable = array('user_id', 'apps_id', 'hidden', 'updated_at', 'created_at');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'favourites';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	public function app(){
		return $this->hasManyThrough('Cerialapp', 'User', 'apps_id', 'user_id');
	}

	public function getFavouritedApp(){
		return $this->belongsTo('Cerialapp', 'apps_id');
	}

	public function getFavouritedAppUser(){
		return $this->belongsTo('User', 'user_id');
	}


}
