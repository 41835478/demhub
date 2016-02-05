### Single Table Inheritance (Staging & Production):

- Inside `App\Models\Content`, comment OUT line 12 or `use SingleTableInheritanceTrait;`
- As an admin, run the port-over script by visiting the url `/admin/runScript`
- Once the script is done, inside `App\Models\Content`, UNcomment line 12 or `use SingleTableInheritanceTrait;`
- In the console, re-run the elasticsearch indexing for articles, discussions, publications and resources
```
$php artisan es:articles-index
$php artisan es:discussions-index
$php artisan es:resources-index
$php artisan es:publication-index
$php artisan es:users-index
```

### Single Table Inheritance (Development):

- `php artisan migrate:refresh --seed`
- Inside `Model\Article`
```php
use Illuminate\Database\Eloquent\Model;
// use App\Models\Content;

class Article extends Model
// class Article extends Content
{
	const LANGUAGE = 0;
	const TYPE = 1;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'articles';

	// protected static $singleTableType = 'article';
```
- Populate articles with scrape urls
- After populating articles, inside `Model\Article`
```php
// use Illuminate\Database\Eloquent\Model;
use App\Models\Content;

// class Article extends Model
class Article extends Content
{
	const LANGUAGE = 0;
	const TYPE = 1;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	// protected $table = 'articles';

	protected static $singleTableType = 'article';
```
- Inside `App\Models\Content`, comment OUT line 12 or `use SingleTableInheritanceTrait;`
- As an admin, run the port-over script by visiting the url `/admin/runScript`
- Once the script is done, inside `App\Models\Content`, UNcomment line 12 or `use SingleTableInheritanceTrait;`
- In the console, re-run the elasticsearch indexing for articles, discussions, publications and resources
```
$php artisan es:articles-index
$php artisan es:discussions-index
$php artisan es:resources-index
$php artisan es:publication-index
$php artisan es:users-index
```
