<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Conversation extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	protected $fillable = array('user_id', 'xml_category_feed_id', 'comment', 'hidden', 'updated_at', 'created_at');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'conversation';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	public function getUser() {
		return $this->hasOne('User', 'id' ,'user_id');
	}
	public function getCategory(){
		return $this->hasOne('Xmlcategories', 'id', 'xml_category_feed_id');
	}

	public function getReplies(){
		return $this->hasMany('Reply', 'conversation_id');
	}


}
