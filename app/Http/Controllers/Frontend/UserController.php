<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class UserController extends Controller {

	/**
	 * User Homepage
	 */
	public function index(Request $request){

		$allDivisions = $navDivisions = Division::all();
		$currentDivision = Division::find(1);
		$currentDivision->slug      = "all";
		$currentDivision->name      = "All Divisions";

		$query = DB::table('articles')->select("*");
		$query = $query->where('deleted', 0);

    if ($request) {
      $options_query = 	$request->input('query_term', '');	// (optional) search query
      $options_page = 	$request->input('page', 1);					// (optional) page number defaults to 1
  		$options_count = 	$request->input('count', 60);				// (optional) items per page defaults to 30

      if(trim($options_query) != ''){
  			$keywords = explode(' ', $options_query);
  			foreach($keywords as $keyword){
  				$query = $query->whereRaw("(`title` LIKE ? OR `keywords` LIKE ?)", array('%'.$keyword.'%', '%|'.$keyword.'|%'));
  			}
  		} // if ($options_query) ends

			$query_term = $options_query;

    } else {

      $options_page   = 1;		// (optional) page number defaults to 1
  		$options_count  = 60;		// (optional) items per page defaults to 30
			$query_term = NULL;

    } // if ($request) ends

    $query = $query->orderBy('publish_date', 'desc');
		$total_count = $query->count();
		$query = $query->skip( ($options_page - 1) * $options_count );
		$query = $query->take( $options_count );
		$newsFeeds = $query->get();

		$item_count = count($newsFeeds);
		$last_page = $item_count < $options_count;

    return view('frontend.user.userhome', compact([
      'allDivisions', 'navDivisions', 'currentDivision', 'newsFeeds', 'query_term', 'total_count', 'options_page', 'options_count', 'item_count', 'last_page'
    ]));

	}

	// private function paginate($newsFeeds){
	//
	// 	// Set our paging values
	// 	$start = (isset($_GET['start']) && !empty($_GET['start'])) ? $_GET['start'] : 0; // Where do we start?
	// 	$length = (isset($_GET['length']) && !empty($_GET['length'])) ? $_GET['length'] : 5; // How many per page?
	// 	$max = $newsFeeds->get_item_quantity(); // Where do we end?
	//
	//
	// 	// Let's do our paging controls
	// 	 $next = (int) $start + (int) $length;
	// 	 $prev = (int) $start - (int) $length;
	//
	// 	// Create the NEXT link
	// 	 $nextlink = '<a href="?start=' . $next . '&length=' . $length . '">Next &raquo;</a>';
	// 	if ($next > $max)
	// 	{
	// 		$nextlink = 'Next &raquo;';
	// 	}
	//
	// 	// Create the PREVIOUS link
	// 	 $prevlink = '<a href="?start=' . $prev . '&length=' . $length . '">&laquo; Previous</a>';
	// 	if ($prev < 0 && (int) $start > 0)
	// 	{
	// 		$prevlink = '<a href="?start=0&length=' . $length . '">&laquo; Previous</a>';
	// 	}
	// 	else if ($prev < 0)
	// 	{
	// 		$prevlink = '&laquo; Previous';
	// 	}
	//
	// 	// Normalize the numbering for humans
	// 	 $begin = (int) $start + 1;
	// 	 $end = ($next > $max) ? $max : $next;
	// 	 $variables = array($start,$length,$max,$next,$prev,$nextlink,$prevlink,$begin,$end);
	// 	 return $variables;
	// }
}
