<?php namespace App\Models\Access\User;

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
		if(strpos($this->division, "|") !== false){
			$divisions = [];
			if (isset($this->division)) {
					foreach (array_filter(preg_split("/\|/", $this->division)) as $divId) {
							// TODO - change data to deal with ids instead of slugs
							$div = Division::where('id', $divId)->firstOrFail();
							$divisions[$div->slug] = $div->name;
					}
			} else {
					$divisions = NULL;
			}

			return $divisions;
		} else {
			return $this->division;
		}
	}

	public function followers() {
		return $this->belongsToMany('App\Models\Access\User\User','follow_relationships','followed_id','follower_id')
								->withTimestamps();
	}

	public function following() {
		return $this->belongsToMany('App\Models\Access\User\User','follow_relationships','follower_id','followed_id')
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
					    ->count() > 0;
	}

}
