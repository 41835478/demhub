<?php

namespace DEMHub\Models;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model {

	protected $fillable = ['avatar_user_id', 'file_name', 'updated_at', 'created_at'];
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'avatar';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = []];


	public function user(){
		return $this->belongsTo('User');
	}

	public function registration(){
		return $this->belongsTo('Registration');
	}

}
