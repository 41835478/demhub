<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Http\Controllers\Controller;
use SimplePie;
use Request;

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
      $currentDivision->bg_color  = "000";
      $currentDivision->name      = "All Divisions";

      $allDivisions = $navDivisions = Division::all();
	    $userMenu = false;

      $newsFeeds = array();
      foreach ($allDivisions as $div) {
        $newsFeeds = array_merge($newsFeeds, $div->newsFeeds->lists('url')->all());
      }
      $newsFeeds = array_unique($newsFeeds, SORT_REGULAR);
      $newsFeeds = $this -> simplepie_feed($newsFeeds);

      return view('division.index', compact([
        'allDivisions', 'navDivisions', 'currentDivision', 'newsFeeds', 'userMenu'
      ]));
    }

    public function show($divisionId)
    {
      $currentDivision = Division::where('slug', $divisionId)->firstOrFail();

      $allDivisions = $navDivisions = Division::all();
	    $userMenu = false;

      $newsFeeds = $currentDivision->newsFeeds->lists('url')->all();
      $newsFeeds = $this -> simplepie_feed($newsFeeds);

      return view('division.show', compact([
        'allDivisions', 'navDivisions', 'currentDivision', 'newsFeeds', 'userMenu'
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
      $newsFeeds = $this -> simplepie_feed($newsFeeds);

      $query = Request::get('search');
      $pattern = "/".$query."/i";

      $url = parse_url(Request::get('route'));
      $url = str_replace("/", ".", $url['path']);

      $compact_vars = [
        'allDivisions', 'navDivisions', 'currentDivision', 'newsFeeds', 'userMenu', 'query', 'pattern'
      ];

      if ($url == "divisions") {
        $currentDivision = Division::find(1);
        $currentDivision->slug = "all";
        $currentDivision->bg_color = "000";
        $currentDivision->name = "All Sections";
        return view('division.index', compact($compact_vars));
      } else {

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
      // $feed->init();
      $feed->handle_content_type();
      return $feed;
	  }
}
