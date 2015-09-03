<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;


class Xmlcategories extends \Eloquent implements UserInterface, RemindableInterface  {
	use UserTrait, RemindableTrait;

	protected $fillable = [];

	protected $table= 'xmlcategories';

	public function xmlfeed(){
		return $this->hasMany('Xml', 'category_id');
	}

	public function xmlfeeddata(){
		return $this->hasMany('Xmlcategoryfeed', 'category_id')
					->orderBy('pubDate', 'desc');
	}

}