<?php

namespace DEMHub\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model {

	protected $fillable = ['user_name', 'user_email', 'user_password' , 'updated_at', 'created_at', 'first_name', 'last_name', 'job_title', 'org_agency', 'phone_number', 'specialization'];

	protected $guarded = ['user_password'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'registration';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function files() {
		return $this->hasMany('Files', 'user_id');
	}

	public function likes() {
		return $this->hasMany('Likes', 'user_id');
	}

	public function getFollowFeed(){
		return $this->hasMany('Followfeed', 'user_id')
								->where('user_id', '=', Auth::user()->id)
								->where('hidden', '=', false);
	}

}
