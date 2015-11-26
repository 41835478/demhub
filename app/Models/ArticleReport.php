<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleReport extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'article_reports';

	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	
}
