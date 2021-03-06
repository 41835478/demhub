<?php namespace App\Models\Access\User;

use App\Http\Components\Helpers;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Access\User\Traits\UserAccess;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Models\Access\User\Traits\Attribute\UserAttribute;
use App\Models\Access\User\Traits\Relationship\UserRelationship;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use DB;
use App\Models\Division;
use Riari\Forum\Models\Thread;
use Riari\Forum\Models\Post;
use App\Models\Content;

/**
 * Class User
 * @package App\Models\Access\User
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract, StaplerableInterface {

	use Authenticatable,
		CanResetPassword,
		SoftDeletes,
		UserAccess,
		UserRelationship,
		UserAttribute,
		EloquentTrait;

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
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * For soft deletes
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	public function __construct(array $attributes = array()) {
      $this->hasAttachedFile('avatar', [
          'styles' => [
              'medium' => '300x300',
              'thumb' => '35x35'
          ],
					'default_url' => '/images/avatars/:style/missing.png'
      ]);

      parent::__construct($attributes);
  }

	/**
	 * @return mixed
	 */
	public function canChangeEmail() {
		return config('access.users.change_email');
	}

	public function full_name() {
		return $this->first_name." ".$this->last_name;
	}

	public function divisions()
	{
		if(!is_array($this->division)){
			if(trim($this->division) == ""){
				return array();
			} else {
				$divisions = [];
				if (isset($this->division)) {
					foreach (Helpers::convertDBStringToArray($this->division) as $divId) {
						// TODO - change data to deal with ids instead of slugs
						$div = Division::where('id', $divId)->firstOrFail();
						$divisions[$div->slug] = $div->name;
					}
				} else {
					$divisions = NULL;
				}

				return $divisions;
			}

		} else {
			return $this->division;
		}
	}



    public function bookmarks() {

        $follows = DB::table('follow_relationships')
                        ->whereIn('followed_type', [self::THREAD,self::PUBLICATION,self::ARTICLE])
                        ->whereFollowerId($this->id)
                        ->whereFollowerType(self::USER)
                        ->get();

        $contentIds=[];
        foreach($follows as $key => $follow){
            $contentIds[$key]=$follow->followed_id;
        };

        $items = Content::whereIn('id',$contentIds)
                        ->get();

        return $items;
	}

	public function threadBookmarks() {
		return $this->belongsToMany('Riari\Forum\Models\Thread','follow_relationships','follower_id','followed_id')
								->whereFollowerType(self::USER)
								->whereFollowedType(self::THREAD)
								->withTimestamps();
	}

	public function publicationBookmarks() {
		return $this->belongsToMany('App\Models\Publication','follow_relationships','follower_id','followed_id')
								->whereFollowerType(self::USER)
								->whereFollowedType(self::PUBLICATION)
								->withTimestamps();
	}

	// TODO - Add a hasMany relation to this function
	public function discussions()
	{
			$threadIds = Post::where('author_id',$this->id)->lists('parent_thread');
			$threads = DB::table('contents')->whereIn('id', $threadIds)->get();

			$collection = collect($threads);
			return $collection;
	}

	/**
   	 * One-to-Many relations with Publication.
   	 *
   	 * @return \Illuminate\Database\Eloquent\Relations\hasMany
   	 */
	public function publications()
    {
      return $this->hasMany('App\Models\Publication', 'owner_id')
									->where('deleted', 0)
									->orderBy('id', 'DESC');
    }

	public function contentBookmarks() {
		return $this->belongsToMany('App\Models\Content','follow_relationships','follower_id','followed_id')
								->whereFollowerType(self::USER)
								->whereIn('followed_type', [self::ARTICLE, self::PUBLICATION, self::RESOURCE, self::THREAD])
								->withTimestamps();
	}

	public function has_bookmarked_content($bookmarked_content, $content_type) {
		if (is_numeric($bookmarked_content)) {
			$followed_content_id = $bookmarked_content;
		} else {
			$followed_content_id = $bookmarked_content->id;
		}

		switch ($content_type) {
			case 'article':
				$content_type = self::ARTICLE;
				break;

			case 'infoResource':
				$content_type = self::RESOURCE;
				break;

			case 'thread':
				$content_type = self::THREAD;
				break;

			case 'publication':
				$content_type = self::PUBLICATION;
				break;

			default:
				// nothing // this shouldn't happen
				break;
		}

		return DB::table('follow_relationships')
					    ->whereFollowerId($this->id)
					    ->whereFollowedId($followed_content_id)
						->whereFollowerType(self::USER)
						->whereFollowedType($content_type)
					    ->count() > 0;
	}

	public function followers() {
		return $this->belongsToMany('App\Models\Access\User\User','follow_relationships','followed_id','follower_id')
								->whereFollowerType(self::USER)
								->whereFollowedType(self::USER)
								->withTimestamps();
	}

	public function following() {
		return $this->belongsToMany('App\Models\Access\User\User','follow_relationships','follower_id','followed_id')
								->whereFollowerType(self::USER)
								->whereFollowedType(self::USER)
								->withTimestamps();
	}

	public function is_following($followed_user) {
		if (is_numeric($followed_user)) {
			$followed_user_id = $followed_user;
		} else {
			$followed_user_id = $followed_user->id;
		}

		return DB::table('follow_relationships')
					    ->whereFollowerId($this->id)
					    ->whereFollowedId($followed_user_id)
						->whereFollowerType(self::USER)
						->whereFollowedType(self::USER)
					    ->count() > 0;
	}

}
