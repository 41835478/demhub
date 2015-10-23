<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Http\Controllers\Controller;
use SimplePie;


/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class UserController extends Controller {

	/**
	 * User Homepage
	 */
	public function showUserHome(){
        $allDivisions = Division::all();

        $newsFeeds = array();
        // foreach ($allDivisions as $div) {
        //   $newsFeeds = array_merge($newsFeeds, $div->newsFeeds->lists('url')->all());
        // }
        // $newsFeeds = $this -> simplepie_feed($newsFeeds);
		return view('frontend.user.userhome', [
					'allDivisions' => $allDivisions,
					'newsFeeds' => $newsFeeds
					]);

	}


	/**
	 * @return \Illuminate\View\View
	 */
	public function macros()
	{
		return view('frontend.macros');
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function about()
	{
		return view('frontend.about');
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function policy()
	{
		return view('frontend.policy');
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function terms()
	{
		return view('frontend.terms');
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
