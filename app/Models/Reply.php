<?php

namespace DEMHub\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model {

	protected $fillable = ['user_id', 'conversation_id', 'reply_paragraph' ,'hidden', 'updated_at', 'created_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'conversation_replies';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	public function getUser(){
		return $this->hasOne('User', 'id' ,'user_id');
	}


}
