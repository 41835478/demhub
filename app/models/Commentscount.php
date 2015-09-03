<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Commentscount extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	protected $fillable = array('count', 'feed_id', 'hidden', 'updated_at', 'created_at');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments_count';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	public function getFeed(){
		return $this->belongsTo('Xmlcategoryfeed', 'feed_id', 'id');
	}

}
