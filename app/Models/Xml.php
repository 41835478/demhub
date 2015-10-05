<?php

namespace DEMHub\Models;

use Illuminate\Database\Eloquent\Model;

class Xml extends Model {

	protected $fillable = ['url', 'category_id' ,'updated_at', 'created_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'xml';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];
}
