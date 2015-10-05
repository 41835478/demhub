<?php

namespace DEMHub\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceEntry extends Model {

	protected $fillable = ['id', 'title', 'entry','country', 'region'];

	// protected $guarded = ['user_password'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'resource_entries';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = array('password', 'remember_token');

}
