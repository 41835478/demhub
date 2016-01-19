<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;
use App\Models\Division;
use DateTime;

class Content extends Model
{
    // NOTE - when running the port over script in DashboardController
<<<<<<< HEAD
    // Comment the following trait out
=======
    // Comment the following table out
>>>>>>> 67f4471a301c1a04a9fe8af0934ba120a210172e
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
            foreach (array_filter(preg_split("/\|/", $this->divisions)) as $divID) {
                $div = Division::findOrFail($divID);
                $divisions[$div->slug] = $div->name;
            }
        } else {
            $divisions = NULL;
        }

        return $divisions;
    }

    public function keywords()
    {
		$keywords = str_replace('|virus|', '|viral|', $this->keywords);
		return array_filter(preg_split("/\|/", $keywords));
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
