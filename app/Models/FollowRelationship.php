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
	protected $table = 'follow_relationships';

	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * Publication date attribute
	 *
	 * @var array
	 */
	protected $dates = ['created_at', 'updated_at'];

	public function follower() {
		$model = NULL;
		switch ($this->follower_type) {
			case 'A': // ARTICLE
				$model = 'App\Models\Article';
				break;

			// NOTE - ORGANIZATION Not yet in use
			// case 'O': // ORGANIZATION
			// 	# code...
			// 	break;

			case 'P': // PUBLICATION
				$model = 'App\Models\Publication';
				break;

			case 'U':
				$model = 'App\Models\Access\User\User';
				break;

			default:
				return NULL;
				break;
		}
		return $this->belongsTo($model, 'follower_id');
	}

	public function followed() {
		$model = NULL;
		switch ($this->followed_type) {
			case 'A': // ARTICLE
				$model = 'App\Models\Article';
				break;

			case 'D': // DIVISION
				$model = 'App\Models\Division';
				break;

			case 'K': // KEYWORD
				$model = 'App\Models\Keyword';
				break;

			case 'L': // LOCATION
				$model = 'App\Models\Location';
				break;

			// NOTE - ORGANIZATION Not yet in use
			// case 'O': // ORGANIZATION
			// 	# code...
			// 	break;

			case 'P': // PUBLICATION
				$model = 'App\Models\Publication';
				break;

			case 'R': // RESOURCE
				$model = 'App\Models\InfoResource';
				break;

			case 'S': // SCRAPE_SOURCE
				$model = 'App\Models\ScrapeSource';
				break;

			case 'T': // THREAD
				$model = 'Riari\Forum\Models\Thread';
				break;

			case 'U': // USER
				$model = 'App\Models\Access\User\User';
				break;

			default:
				return NULL;
				break;
		}
		return $this->belongsTo($model, 'followed_id');
	}
}
