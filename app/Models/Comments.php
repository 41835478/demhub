<?php

namespace DEMHub\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model {

	protected $fillable = ['user_id', 'xml_category_feed_id', 'comment', 'hidden', 'updated_at', 'created_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	public function getUser() {
		return $this->hasOne('User', 'id' ,'user_id');
	}

}
