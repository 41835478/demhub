<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Http\Controllers\Controller;
use SimplePie;
use Request;
use DB;

class DivisionController extends Controller
{
    /**
    * Show a list of all available divisions.
    *
    * @return Response
    */
    public function index()
    {
      $allDivisions = Division::all();
	    $userMenu = false;

      $newsFeeds = array();
      foreach ($allDivisions as $div) {
        $newsFeeds = array_merge($newsFeeds, $div->newsFeeds->lists('url')->all());
      }
      $newsFeeds = $this -> simplepie_feed($newsFeeds);

      return view('division.index', [
        'allDivisions' => $allDivisions,
        'navDivisions' => $allDivisions,
        'newsFeeds' => $newsFeeds,
		    'userMenu' => $userMenu
      ]);
    }

    public function show($divisionId)
    {
      $allDivisions = Division::all();
	    $userMenu = false;
      $division = Division::where('slug', $divisionId)->firstOrFail();

      $newsFeeds = $division->newsFeeds->lists('url')->all();
      $newsFeeds = $this -> simplepie_feed($newsFeeds);

      return view('division.show', [
        'allDivisions' => $allDivisions,
        'division' => $division,
        'navDivisions' => $allDivisions,
        'newsFeeds' => $newsFeeds,
		    'userMenu' => $userMenu
      ]);
    }

    public function results()
    {
      $allDivisions = Division::all();
	    $userMenu = false;

      $query = Request::get('search');

      $queryResults = DB::table('news_feeds_cache_data')->where('data', 'LIKE', '%' . $query . '%')
        ->lists('data');

      dd($queryResults[0]);

      return view('division.results', [
        'allDivisions' => $allDivisions,
        'navDivisions' => $allDivisions,
        'queryResults' => $queryResults,
		    'userMenu' => $userMenu
      ]);
    }

    private function simplepie_feed($newsFeeds)
    {
		  $feed = new SimplePie();

		  $feed->set_feed_url($newsFeeds);
		  $feed->enable_cache(true); $feed->set_cache_location('mysql://'.getenv('DB_USERNAME').':'.getenv('DB_PASSWORD').'@'.getenv('DB_HOST').':3306/'.getenv('DB_DATABASE').'?prefix=news_feeds_');
      $feed->set_cache_duration(60*60); // (sec*mins)
      $feed->set_output_encoding('utf-8');
      $feed->set_item_limit(1);
      // dd($feed);

      $feed->init();
      $feed->handle_content_type();
      return $feed;
	  }
}
