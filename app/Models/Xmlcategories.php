<?php

namespace DEMHub\Models;

use Illuminate\Database\Eloquent\Model;

class Xmlcategories extends Model {

	protected $fillable = ['id', 'category_name', 'bg_image', 'bg_color'];

	protected $table= 'xmlcategories';

	public function xmlfeed(){
		return $this->hasMany('Xml', 'category_id');
	}

	// public function xmlfeeddata(){
	// 	return $this->hasMany('Xmlcategoryfeed', 'category_id')
	// 							->orderBy('pubDate', 'desc');
	// }

}
