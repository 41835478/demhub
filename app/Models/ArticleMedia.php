<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleMedia extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'article_medias';

	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	
}
