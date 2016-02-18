<?php namespace App\Models;

use App\Http\Components\Helpers;
use Illuminate\Database\Eloquent\Model;
use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;
use App\Models\Division;
use App\Models\Access\User\User;
use DateTime;
use DB;
use Riari\Forum\Models\Thread;
use Riari\Forum\Models\Post;

class Content extends Model
{
    // NOTE - when running the port over script in DashboardController
    // Comment the following trait out
    use SingleTableInheritanceTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contents';

    protected static $singleTableTypeField = 'subclass';

    protected static $singleTableSubclasses = [
        Article::class,
        InfoResource::class,
        \Riari\Forum\Models\Thread::class,
        Publication::class
    ];

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
	protected $dates = ['publish_date', 'created_at', 'updated_at'];

    /**
     * Divisions associated with content
     *
     * @return \ArrayObject
     */
    public function divisions()
    {
        $divisions = [];
        if (isset($this->divisions)) {
            foreach (Helpers::convertDBStringToArray($this->divisions) as $divID) {
                $div = Division::findOrFail($divID);
                $divisions[$div->slug] = $div->name;
            }
        } else {
            $divisions = array();
        }

        return $divisions;
    }

    public function keywords()
    {
		$keywords = str_replace('|virus|', '|viral|', $this->keywords);
		return Helpers::convertDBStringToArray($keywords);
    }

    public function humanReadablePublishDate()
    {
		return date_format(new DateTime($this->publish_date), 'j F Y');
    }

    /**
     * One-to-Many relations with Publication.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
	public function medias()
    {
        return $this->hasMany('App\Models\ContentMedia', 'content_id')
                    ->where('deleted', 0)
                    ->orderBy('view_order', 'ASC');
    }
    public function check_for_article_discussions() {

      $contentId = $this['id'];
      $postIds = DB::table('follow_relationships')->whereIn('follower_type',['A','P'])
                ->whereFollowerId($contentId)
                ->whereFollowedType('P')
                ->select('followed_id')
                ->get();
      if (! $postIds){
        $threadIds = DB::table('follow_relationships')->whereIn('follower_type',['A','P'])
                  ->whereFollowerId($contentId)
                  ->whereFollowedType('T')
                  ->select('followed_id')
                  ->get();
        if ($threadIds){
            $threadArray=[];
            foreach ($threadIds as $key => $t) {
                $threadArray[$key]=$t->followed_id;
            }
            $threads = Thread::whereIn('id',$threadArray)->get();

            return (! $threads) ?  '' : $threads;
        };
      }
      else {
          $posts = Post::whereIn('id',$postIds)->get();
          return $posts;
      }
    }
    public function contents_relation_data($classThis,$classB) {
        $typeThis=strtoupper(substr($classThis,0,1));
        $typeB=strtoupper(substr($classB,0,1));
        $contentId = $this['id'];
        $relationsThis = DB::table('follow_relationships')->where('follower_type',$typeThis)
                ->whereFollowerId($contentId)
                ->whereFollowedType($typeB)
                ->select('followed_id')
                ->get();
        if ($relationsThis){

            $contentArrayThis=array();
            foreach ($relationsThis as $key => $selection) {
                $contentArrayThis[$key]=$selection->followed_id;
            }
        }
        $relationsB = DB::table('follow_relationships')->where('follower_type',$typeB)
                ->whereFollowedId($contentId)
                ->whereFollowedType($typeThis)
                ->select('follower_id')
                ->get();
        if ($relationsB){

            $contentArrayB=array();
            foreach ($relationsB as $key => $selection) {
                $contentArrayB[$key]=$selection->follower_id;
            }
        }


        if ($relationsThis || $relationsB){
            if (! empty($contentArrayThis) && ! empty($contentArrayB)){
            $contentArray=array_merge($contentArrayThis,$contentArrayB);
            } elseif (! empty($contentArrayThis)){
                $contentArray=$contentArrayThis;
            } else if (! empty($contentArrayB)){
                $contentArray=$contentArrayB;
            } else {
            };

            //$items = Thread::whereIn('id',$threadArray)->get();
            $classB=ucfirst($classB);
            if($classB=="User") {
                $items=User::whereIn('id',$contentArray)->get();
            } else {
                $items=Content::whereIn('id',$contentArray)->get();
            };


            return (! $items) ?  null : $items;
        };
        return null;

    }

    public function connectedContent($followerClass,$followedClass) {
		$conn=check_for_relation($followerClass,$followedClass);
        if($conn){
            $items = Content::whereIn($conn)
                    ->get();

            return $items;
        }
        else {
            return null;
        }

	}
    public function same_division_same_class(){
        //$class=ucfirst($this['subclass']);
        $type=strtoupper(substr($this['subclass'],0,1));
        $firstDivision=strtoupper(substr($this['divisions'],1,1));
        if (isset($firstDivision)){
            $items = Content::where('subclass',$this['subclass'])
                    ->where('divisions','LIKE', '%'.$firstDivision.'%')
                    ->where(id,'!=',$this['id'])
                    ->get();
            return $items;
        };
        return null;

    }

    public function connectToDiscussion() {
		return $this->belongsToMany('Riari\Forum\Models\Thread','follow_relationships','follower_id','followed_id')
								->whereFollowerType('A')
								->whereFollowedType('T')
								->withTimestamps();
	}

    public function mainMedia()
    {
        return $this->medias()->first();
    }

    public function mainMediaName()
    {
        return $this->mainMedia() ? $this->mainMedia()->resource_file_name : NULL;
    }

    public function mainMediaUrl()
    {
        return $this->mainMedia() ? $this->mainMedia()->resource->url() : NULL;
    }
}
