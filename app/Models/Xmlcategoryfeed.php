<?php

namespace DEMHub\Models;

use Illuminate\Database\Eloquent\Model;

class Xmlcategoryfeed extends Model {

	protected $fillable = ['category_id' , 'title', 'link','desc', 'hidden','pubDate', 'keywords' ,'updated_at', 'created_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'xml_category_feed';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	public function getcategory(){
		return $this->belongsTo('Xmlcategories', 'category_id');
	}

	public function getUserFeed() {
		return $this->hasMany('Followfeed', 'category_id', 'category_id')
								->where('user_id', '=', Auth::user()->id)
								->where('hidden', '=', false);
	}

	public function getLikes(){
		return $this->hasMany('Likes', 'feed_id')
								->where('hidden', '=', false);
	}

	public function getDescLikes(){
		return $this->getLikes();
	}

	public function getDislikes(){
		return $this->hasMany('Dislikes', 'xml_category_feed_id')
								->where('hidden', '=', false);
	}

	public function getComments() {
		return $this->hasMany('Comments', 'xml_category_feed_id')
								->where('hidden', '=', false)
								->orderBy('updated_at', 'desc');
	}


}
