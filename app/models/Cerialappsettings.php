<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Cerialappsettings extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	
	protected $fillable = array('app_id', 'app_board', 'app_key', 'app_secret','app_configured','updated_at', 'created_at');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'apps_settings';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	public function app(){
		return $this->belongsTo('Cerialapp');
	}

}
