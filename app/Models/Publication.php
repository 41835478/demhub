<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Publication extends Model implements StaplerableInterface {

	use SoftDeletes,
			EloquentTrait;

  /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'publications';

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
	protected $dates = ['deleted_at'];

	/**
   * Create a new publication instance with a document attachment.
   *
   * @param  Array $attributes
   *
   * @return void
   */

  public function __construct(array $attributes = array()) {
      $this->hasAttachedFile('document', []);

      parent::__construct($attributes);
  }

	/**
   * Many-to-One relations with User.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
	public function uploader()
  {
      return $this->belongsTo('App\Models\Access\User\User', 'user_id');
  }
}
