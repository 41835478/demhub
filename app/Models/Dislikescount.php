<?php

namespace DEMHub\Models;

use Illuminate\Database\Eloquent\Model;

class Dislikescount extends Model {

	protected $fillable = ['count', 'feed_id', 'hidden', 'updated_at', 'created_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'dislikes_count';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	public function getFeed(){
		return $this->belongsTo('Xmlcategoryfeed', 'feed_id', 'id');
	}

}
