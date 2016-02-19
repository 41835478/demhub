<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowRelationship extends Model
{
	// Follower and followed types
	// Including connections, bookmarks, tracking, etc.
    const ARTICLE       = 'A';
	const DIVISION      = 'D';
	const KEYWORD       = 'K';
	const LOCATION      = 'L';
	// const ORGANIZATION  = 'O'; // NOTE - Not yet in use
	const PUBLICATION   = 'P';
	const RESOURCE 		= 'R';
	const SCRAPE_SOURCE = 'S';
	const THREAD        = 'T';
	const USER          = 'U';

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'keywords';

	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	public function follower()
	{
		return $this->hasMany('App\Models\NewsFeed');
	}
}
