<?php

namespace DEMHub\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model {

	protected $fillable = ['file_name', 'file_original_name', 'file_size' , 'user_id', 'hidden' ,'updated_at', 'created_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'feedback';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];
}
