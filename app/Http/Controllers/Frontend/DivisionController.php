<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Models\ArticleMedia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Riari\Forum\Models\Thread;
use Riari\Forum\Events\ThreadWasViewed;
use Riari\Forum\Repositories\Categories;
use Riari\Forum\Repositories\Threads;
use Riari\Forum\Repositories\Posts;
use Riari\Forum\Libraries\AccessControl;
use Riari\Forum\Libraries\Alerts;
use Riari\Forum\Libraries\Utils;
use Riari\Forum\Libraries\Validation;
use DB;

class DivisionController extends Controller
{
    /**
    * Show a list of all available divisions.
    *
    * @return Response
    */

    public function index(Request $request)
    {
      $currentDivision = Division::find(1);
      $currentDivision->slug      = "all";
      $currentDivision->name      = "All Divisions";

      $allDivisions = $navDivisions = Division::all();
	    $userMenu = false;

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
      $articleMediaArray=[];
      $query = $query->orderBy('publish_date', 'desc');

      $total_count = $query->count();
      $query = $query->skip( ($options_page - 1) * $options_count );
      $query = $query->take( $options_count );
      $newsFeeds = $query->get();
      foreach ($newsFeeds as $item){
        $itemMedia=ArticleMedia::where('article_id',$item->id)->first();
        if ($itemMedia){
        array_push($articleMediaArray,$itemMedia);
        }
      }
      $item_count = count($newsFeeds);
      $last_page = $item_count < $options_count;

      return view('division.index', compact([
        'allDivisions', 'navDivisions', 'currentDivision', 'newsFeeds', 'articleMediaArray', 'userMenu', 'threads',
        'query_term', 'total_count', 'options_page', 'options_count', 'item_count', 'last_page'
      ]));
    }


    public function show($divisionSlug, Request $request)
    {
      if (is_numeric($divisionSlug)){
        $currentDivision = Division::where('id', $divisionSlug)->firstOrFail();
      }
      else {
      $currentDivision = Division::where('slug', $divisionSlug)->firstOrFail();
      }
      $allDivisions = $navDivisions = Division::all();
	    $userMenu = false;

      $query = DB::table('articles')->select("*");
      $query = $query->where('deleted', 0);
      $query = $query->where('divisions', 'LIKE', '%|'.$currentDivision->id.'|%');

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

      $articleMediaArray=[];
      foreach ($newsFeeds as $item){
        $itemMedia=ArticleMedia::where('article_id',$item->id)->first();
        if ($itemMedia){
        array_push($articleMediaArray,$itemMedia);
        }
      }

      $item_count = count($newsFeeds);
      $last_page = $item_count < $options_count;

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
        'allDivisions', 'navDivisions', 'currentDivision', 'newsFeeds', 'userMenu', 'articleMediaArray',
        'threads','query_term', 'total_count', 'options_page', 'options_count', 'item_count', 'last_page'
      ]));

    }


}
