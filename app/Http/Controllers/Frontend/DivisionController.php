<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Http\Controllers\Controller;
use SimplePie;
use Request;
use Riari\Forum\Models\Thread;
use Riari\Forum\Events\ThreadWasViewed;
use Riari\Forum\Repositories\Categories;
use Riari\Forum\Repositories\Threads;
use Riari\Forum\Repositories\Posts;
use Riari\Forum\Libraries\AccessControl;
use Riari\Forum\Libraries\Alerts;
use Riari\Forum\Libraries\Utils;
use Riari\Forum\Libraries\Validation;

class DivisionController extends Controller
{
    /**
    * Show a list of all available divisions.
    *
    * @return Response
    */
    public function index()
    {
      $currentDivision = Division::find(1);
      $currentDivision->slug      = "all";
      $currentDivision->name      = "All Divisions";

      $allDivisions = $navDivisions = Division::all();
	    $userMenu = false;

      $newsFeeds = array();
      foreach ($allDivisions as $div) {
        $newsFeeds = array_merge($newsFeeds, $div->newsFeeds->lists('url')->all());
      }
      $newsFeeds = array_unique($newsFeeds, SORT_REGULAR);
      $newsFeeds = $this -> simplepie_feed($newsFeeds);

      $paginateVars = $this->paginate($newsFeeds);
      $start        = $paginateVars[0];
      $length       = $paginateVars[1];
      $max          = $paginateVars[2];
      $next         = $paginateVars[3];
      $prev         = $paginateVars[4];
      $nextlink     = $paginateVars[5];
      $prevlink     = $paginateVars[6];
      $begin        = $paginateVars[7];
      $end          = $paginateVars[8];

      $threads = array();
      $tempThreads = array();
      $threads[0] = Thread::where('parent_category', $currentDivision->id)->orderBy('created_at', 'desc')->first();
      $tempThreads = Thread::where('parent_category', $currentDivision->id)->orderBy('updated_at', 'desc')->get();
      if ($tempThreads[0] = $threads[0]){
        $threads[1]=$tempThreads[1];
      }
      else {
        $threads[1]=$tempThreads[0];
      }
      return view('division.index', compact([
        'allDivisions', 'navDivisions', 'currentDivision', 'newsFeeds', 'userMenu', 'threads', 'start' , 'length' , 'max' , 'next' , 'prev' , 'nextlink' , 'prevlink' , 'begin' , 'end'
      ]));
    }

    public function show($divisionId)
    {
      $currentDivision = Division::where('slug', $divisionId)->firstOrFail();

      $allDivisions = $navDivisions = Division::all();
	    $userMenu = false;

      $newsFeeds    = $currentDivision->newsFeeds->lists('url')->all();
      $newsFeeds    = $this -> simplepie_feed($newsFeeds);
      $paginateVars = $this->paginate($newsFeeds);
      $start        = $paginateVars[0];
      $length       = $paginateVars[1];
      $max          = $paginateVars[2];
      $next         = $paginateVars[3];
      $prev         = $paginateVars[4];
      $nextlink     = $paginateVars[5];
      $prevlink     = $paginateVars[6];
      $begin        = $paginateVars[7];
      $end          = $paginateVars[8];

      $threads = array();
      $tempThreads = array();
      $threads[0] = Thread::where('parent_category', $currentDivision->id)->orderBy('created_at', 'desc')->first();
      $tempThreads = Thread::where('parent_category', $currentDivision->id)->orderBy('updated_at', 'desc')->get();
      if ($tempThreads[0] = $threads[0]){
        $threads[1]=$tempThreads[1];
      }
      else {
        $threads[1]=$tempThreads[0];
      }
      return view('division.index', compact([
        'allDivisions', 'navDivisions', 'currentDivision', 'threads', 'newsFeeds', 'userMenu', 'start' , 'length' , 'max' , 'next' , 'prev' , 'nextlink' , 'prevlink' , 'begin' , 'end'
      ]));

    }

    public function results()
    {
      $allDivisions = $navDivisions = Division::all();
	    $userMenu = false;

      $newsFeeds = array();

      foreach ($allDivisions as $div) {
        $newsFeeds = array_merge($newsFeeds, $div->newsFeeds->lists('url')->all());
      }
      $newsFeeds = array_unique($newsFeeds, SORT_REGULAR);
      $newsFeeds = $this -> simplepie_feed($newsFeeds);

      $query = Request::get('search');
      $pattern = "/".$query."/i";

      $url = parse_url(Request::get('route'));
      $url = explode("/", $url['path']);
      $url_base = $url[0];

      $compact_vars = [
        'allDivisions', 'navDivisions', 'currentDivision', 'newsFeeds', 'userMenu', 'query', 'pattern'
      ];

      if ($url_base == "divisions") {
        $currentDivision = Division::find(1);
        $currentDivision->slug = "all";
        $currentDivision->bg_color = "000";
        $currentDivision->name = "All Sections";
        return view('division.index', compact($compact_vars));
      } else {
        $url_slug = $url[1];
        $currentDivision = Division::where('slug', $url_slug)->firstOrFail();
        return view('division.show', compact($compact_vars));
      }

    }

    private function simplepie_feed($newsFeeds)
    {
		  $feed = new SimplePie();
		  $feed->set_feed_url($newsFeeds);
		  $feed->enable_cache(true); $feed->set_cache_location('mysql://'.getenv('DB_USERNAME').':'.getenv('DB_PASSWORD').'@'.getenv('DB_HOST').':3306/'.getenv('DB_DATABASE').'?prefix=news_feeds_');
      $feed->set_cache_duration(60*60); // (sec*mins)
      $feed->set_output_encoding('utf-8');
      $feed->init();
      $feed->handle_content_type();
      return $feed;
	  }
    private function paginate($newsFeeds){

      // Set our paging values
      $start = (isset($_GET['start']) && !empty($_GET['start'])) ? $_GET['start'] : 0; // Where do we start?
      $length = (isset($_GET['length']) && !empty($_GET['length'])) ? $_GET['length'] : 5; // How many per page?
      $max = $newsFeeds->get_item_quantity(); // Where do we end?

      // Let's do our paging controls
      $next = (int) $start + (int) $length;
      $prev = (int) $start - (int) $length;

      // Create the NEXT link
      $nextlink = '<a href="?start=' . $next . '&length=' . $length . '">Next &raquo;</a>';
      if ($next > $max)
      {
      	$nextlink = 'Next &raquo;';
      }

      // Create the PREVIOUS link
      $prevlink = '<a href="?start=' . $prev . '&length=' . $length . '">&laquo; Previous</a>';
      if ($prev < 0 && (int) $start > 0)
      {
      	$prevlink = '<a href="?start=0&length=' . $length . '">&laquo; Previous</a>';
      }
      else if ($prev < 0)
      {
      	$prevlink = '&laquo; Previous';
      }

      // Normalize the numbering for humans
      $begin = (int) $start + 1;
      $end = ($next > $max) ? $max : $next;
      $variables = array($start,$length,$max,$next,$prev,$nextlink,$prevlink,$begin,$end);
      return $variables;
    }
}
