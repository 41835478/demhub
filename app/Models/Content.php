<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;

class Content extends Model
{
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
        // Thread::class,
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
	protected $dates = ['publish_date'];

    public function divisions()
    {
		// $keywords = str_replace('|virus|', '|viral|', $this->keywords);
		// return array_filter(preg_split("/\|/", $keywords));
        return true;
    }

    public function keywords()
    {
		$keywords = str_replace('|virus|', '|viral|', $this->keywords);
		return array_filter(preg_split("/\|/", $keywords));
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

    public function mainMedia()
    {
        return $this->medias()->first();
    }

    public function mainMediaName()
    {
        return $this->mainMedia() ? $this->mainMedia()->resource_file_name : false;
    }

    public function mainMediaUrl()
    {
        return $this->mainMedia() ? $this->mainMedia()->resource->url() : false;
    }
}
