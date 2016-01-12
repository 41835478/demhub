<?php namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\Content;

// class Article extends Model
class Article extends Content
{
	const LANGUAGE = 0;
	const TYPE = 1;

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

	public function language()
	{
		return json_decode($this->data, true)[self::LANGUAGE];
	}

	public function type()
	{
		return json_decode($this->data, true)[self::TYPE];
	}
}
