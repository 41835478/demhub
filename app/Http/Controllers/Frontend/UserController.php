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

				$allDivisions = $navDivisions = Division::all();

	      $newsFeeds = array();
	      foreach ($allDivisions as $div) {
	        $newsFeeds = array_merge($newsFeeds, $div->newsFeeds->lists('url')->all());
	      }
	      $newsFeeds = array_unique($newsFeeds, SORT_REGULAR);
	      $newsFeeds = $this -> simplepie_feed($newsFeeds);

	      $paginateVars = $this->paginate($newsFeeds);
	      $start = $paginateVars[0];
	      $length= $paginateVars[1];
	      $max= $paginateVars[2];
	      $next= $paginateVars[3];
	      $prev= $paginateVars[4];
	      $nextlink= $paginateVars[5];
	      $prevlink= $paginateVars[6];
	      $begin= $paginateVars[7];
	      $end= $paginateVars[8];

		return view('frontend.user.userhome', compact([
					'allDivisions', 'newsFeeds', 'start' , 'length' , 'max' , 'next' , 'prev' , 'nextlink' , 'prevlink' , 'begin' , 'end'
					]));

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
