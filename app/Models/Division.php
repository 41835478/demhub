<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
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
  public function newsFeeds()
  {
      return $this->hasMany('App\Models\NewsFeed');
  }

  public function articles()
  {
      return $this->hasMany('App\Models\Article');
  }

}
