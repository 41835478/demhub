<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Followfeed extends \Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	protected $fillable = array( 'user_id' ,'category_id' ,'hidden' ,'updated_at', 'created_at');

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
	protected $hidden = array();

	public function getFeedCategory(){
		return $this->belongsTo('Xmlcategories', 'category_id', 'id');
	}

	public function getFeed() {
		return $this->hasMany('Xmlcategoryfeed', 'category_id', 'category_id')
					->where('hidden', '=', false)
					->orderBy('pubDate', 'desc');
	}

}
