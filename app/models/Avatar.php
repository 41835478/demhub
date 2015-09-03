<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Avatar extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	protected $fillable = array('avatar_user_id', 'file_name', 'updated_at', 'created_at');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'avatar';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();


	public function user(){
        return $this->belongsTo('User');
    }


}
