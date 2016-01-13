<?php namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\Content;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

// class Publication extends Model implements StaplerableInterface
class Publication extends Content implements StaplerableInterface
{

	use EloquentTrait;

	const VOLUME = 0;
	const ISSUES = 1;
	const PAGES = 2;
	const PUBLISHER = 3;
	const INSTITUTION = 4;
	const CONFERENCE = 5;
	const AUTHOR = 6;
	const FAVORITES = 7;
	const VIEWS = 8;

  /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	// protected $table = 'publications';

	protected static $singleTableType = 'publication';

  /**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * For soft deletes
	 *
	 * @var array
	 */
	protected $dates = ['publish_date'];

	/**
   * Create a new publication instance with a document attachment.
   *
   * @param  Array $attributes
   *
   * @return void
   */
  // public function __construct(array $attributes = array()) {
  //     $this->hasAttachedFile('document', []);
	//
  //     parent::__construct($attributes);
  // }

	public function volume()
	{
		return json_decode($this->data, true)[self::VOLUME];
	}

	public function issues()
	{
		return json_decode($this->data, true)[self::ISSUES];
	}

	public function pages()
	{
		return json_decode($this->data, true)[self::PAGES];
	}

	public function publisher()
	{
		return json_decode($this->data, true)[self::PUBLISHER];
	}

	public function institution()
	{
		return json_decode($this->data, true)[self::INSTITUTION];
	}

	public function conference()
	{
		return json_decode($this->data, true)[self::CONFERENCE];
	}

	public function author()
	{
		return json_decode($this->data, true)[self::AUTHOR];
	}

	public function favorites()
	{
		return json_decode($this->data, true)[self::FAVORITES];
	}

	public function views()
	{
		return json_decode($this->data, true)[self::VIEWS];
	}

	public function keywords()
	{
		$keywords = str_replace('|virus|', '|viral|', $this->keywords);
		return array_filter(preg_split("/\|/", $keywords));
	}

	/**
   * One-to-Many relations with Publication.
   *
   * @return \Illuminate\Database\Eloquent\Relations\hasMany
   */
	public function medias()
  {
      return $this->hasMany('App\Models\ContentMedia', 'content_id');
  }

	/**
   * Many-to-One relations with User.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
	public function uploader()
  {
      return $this->belongsTo('App\Models\Access\User\User', 'owner_id');
  }
}
