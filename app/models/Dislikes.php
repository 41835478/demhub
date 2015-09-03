<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Dislikes extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	protected $fillable = array('user_id', 'xml_category_feed_id', 'hidden', 'updated_at', 'created_at');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'dislikes';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	public function getLikedApp(){
		return $this->belongsTo('Cerialapp', 'apps_id');
	}




}
