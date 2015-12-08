<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Elasticquent\ElasticquentTrait;

class Article extends Model
{
	// use ElasticquentTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'articles';

	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	// protected $mappingProperties = [
	// 	'publish_date' => [
	// 		'type' => 'date',
	// 		'format' => 'YYYY-MM-DD HH:MM:SS'
	// 	]
	// ];
}
