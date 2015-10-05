<?php

namespace DEMHub\Models;

use Illuminate\Database\Eloquent\Model;

class Followfeed extends Model {

	protected $fillable = ['user_id' ,'category_id' ,'hidden' ,'updated_at', 'created_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users_follow_xml';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	public function getFeedCategory(){
		return $this->belongsTo('Xmlcategories', 'category_id', 'id');
	}

	public function getFeed() {
		return $this->hasMany('Xmlcategoryfeed', 'category_id', 'category_id')
								->where('hidden', '=', false)
								->orderBy('pubDate', 'desc');
	}

}
