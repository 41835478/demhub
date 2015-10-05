<?php

namespace DEMHub\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceRelation extends Model {

	protected $fillable = ['id', 'country', 'regions'];

	// protected $guarded = ['user_password'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'resource_relations';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = array('password', 'remember_token');




	// public function files() {
// 		return $this->hasMany('Files', 'user_id');
// 	}
//
// 	public function likes() {
// 		return $this->hasMany('Likes', 'user_id');
// 	}
//
// 	public function getFollowFeed(){
// 		return $this->hasMany('Followfeed', 'user_id')
// 					->where('user_id', '=', Auth::user()->id)
// 					->where('hidden', '=', false);
// 	}

}
