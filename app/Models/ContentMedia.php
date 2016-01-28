<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class ContentMedia extends Model implements StaplerableInterface
{
  use EloquentTrait;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'content_media';

  /**
   * The attributes that are not mass assignable.
   *
   * @var array
   */
  protected $guarded = ['id'];

  /**
   * Create a new content media instance with a resource attachment.
   *
   * @param  Array $attributes
   *
   * @return void
   */
  public function __construct(array $attributes = array()) {
      $this->hasAttachedFile('resource', []);

      parent::__construct($attributes);
  }

  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public $timestamps = false;

  /**
   * Many-to-One relations with User.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
	public function contentSource()
  {
      return $this->belongsTo('App\Models\Content', 'content_id');
  }
}
