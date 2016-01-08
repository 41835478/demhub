<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentMedia extends Model
{
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
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public $timestamps = false;
}
