<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsFeed extends Model
{
  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public $timestamps = false;

  /**
   * Get the division record associated with the news feed.
   */
  public function division()
  {
      return $this->belongsTo('App\Models\Division');
  }
}
