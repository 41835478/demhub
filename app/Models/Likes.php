<?php

namespace DEMHub\Models;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model {

	protected $fillable = ['user_id', 'feed_id', 'hidden', 'updated_at', 'created_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'likes';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	public function getFeed(){
		return $this->hasMany('Xmlcategoryfeed','id','feed_id');
	}




}
