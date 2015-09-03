<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Feedback extends \Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	protected $fillable = array('file_name', 'file_original_name', 'file_size' , 'user_id', 'hidden' ,'updated_at', 'created_at');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'feedback';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();
}
