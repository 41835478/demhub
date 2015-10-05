<?php

namespace DEMHub\Models;

use Illuminate\Database\Eloquent\Model;

class Dislikes extends Model {

	protected $fillable = ['user_id', 'xml_category_feed_id', 'hidden', 'updated_at', 'created_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'dislikes';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];




}
