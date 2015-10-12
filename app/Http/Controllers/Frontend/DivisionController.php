<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Http\Controllers\Controller;
use SimplePie;
use Illuminate\Support\Facades\DB;

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

      $newsFeeds = array();
      foreach ($allDivisions as $div) {
        $newsFeeds = array_merge($newsFeeds, $div->newsFeeds->lists('url')->all());
      }
      $newsFeeds = $this -> simplepie_feed($newsFeeds);

      return view('division.index', [
        'allDivisions' => $allDivisions,
        'navDivisions' => $allDivisions,
        'newsFeeds' => $newsFeeds
      ]);
    }

    public function show($divisionId)
    {
      $allDivisions = Division::all();
      $division = Division::where('slug', $divisionId)->firstOrFail();

      $newsFeeds = $division->newsFeeds->lists('url')->all();
      $newsFeeds = $this -> simplepie_feed($newsFeeds);

      return view('division.show', [
        'allDivisions' => $allDivisions,
        'division' => $division,
        'navDivisions' => $allDivisions,
        'newsFeeds' => $newsFeeds
      ]);
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
}
