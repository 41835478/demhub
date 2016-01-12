<?php namespace App\Models;

use App\Models\Content;

class Article extends Content
{

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	// protected $table = 'articles';

	protected static $singleTableType = 'article';

	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];
}
