<?php namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\Content;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Publication extends Content implements StaplerableInterface {

	use EloquentTrait;

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

	/**
   * One-to-Many relations with Publication.
   *
   * @return \Illuminate\Database\Eloquent\Relations\hasMany
   */
	public function medias()
  {
      return $this->hasMany('App\Models\ContentMedia');
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
