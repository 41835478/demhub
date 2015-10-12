<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Http\Controllers\Controller;
use SimplePie;

class DivisionController extends Controller
{
    /**
    * Show a list of all available divisions.
    *
    * @return Response
    */
    public function index()
    {
      $divisions = Division::all();

      return view('division.index', [
        'divisions' => $divisions,
        'nav_divisions' => $divisions
      ]);
    }

    public function show($divisionId)
    {
      $divisions = Division::all();
      $division = Division::where('slug', $divisionId)->firstOrFail();

      $newsFeeds = $division->newsFeeds->lists('url')->all();

      $newsFeeds = $this -> simplepie_feed($newsFeeds);

      return view('division.show', [
        'divisions' => $divisions,
        'division' => $division,
        'nav_divisions' => $divisions,
        'news_feeds' => $newsFeeds
      ]);
    }

    private function simplepie_feed($newsFeeds)
    {
		  $feed = new SimplePie();
		  $feed->set_feed_url($newsFeeds);
		  $feed->enable_cache(false);
      $feed->set_cache_location('mysql://'.getenv('DATABASE_USERNAME').':'.getenv('DATABASE_PASSWORD').'@'.getenv('DATABASE_HOST').':3306/'.getenv('DATABASE_NAME').'?prefix=news_feeds_');
      $feed->set_cache_duration(60*60);
      $feed->set_output_encoding('utf-8');
      $feed->init();
      $feed->handle_content_type();
      return $feed;
	}
}
