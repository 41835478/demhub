<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Models\ArticleMedia;
use App\Http\Controllers\Controller;
use App\Http\Components\Search;
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

/**
 * Class DivisionController
 * @package App\Http\Controllers\Frontend
 */
class DivisionController extends Controller
{
    /**
     * Show a list of all available divisions
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
      $currentDivision = Division::find(1);
      $currentDivision->slug      = "all";
      $currentDivision->name      = "All Divisions";

      $allDivisions = $navDivisions = Division::all();
      $userMenu = false;

      $threads = $this->getDivisionThreads($currentDivision->id);

      if ($request) {
          $options_query = $request->input('query_term', '');	// (optional) search query
          $size = $request->input('count', 30);
          $page = $request->input('page', 1);
          $page -= 1; // ElasticSearch page numbers start from zero
          if(trim($options_query) != ''){
              $query = [
                  'multi_match' => [
                      'query' => $options_query,
                      'fields' => ['title', 'excerpt', 'keywords']
                  ]
              ];
              $results = Search::queryArticles($page, $size, $query);
          } else {
              $results = Search::queryArticles($page, $size);
          }
      } else {
          $results = Search::queryArticles();
      }

      $results_hits = $results['hits'];
      $total_count = $results['total'];

      $articleMediaArray = $this->getArticleMedia($results_hits);
      $newsFeeds = Search::formatElasticSearchToArray($results_hits);

      $item_count = count($newsFeeds);
      $last_page = $size*(1+$page) >= $total_count;
      $options_page = $page + 1;
      $options_count = $size;

      return view('division.index', compact([
        'allDivisions', 'navDivisions', 'currentDivision', 'newsFeeds', 'articleMediaArray', 'userMenu', 'threads',
        'query_term', 'total_count', 'options_page', 'options_count', 'item_count', 'last_page'
      ]));
    }

    public function show($divisionSlug, Request $request)
    {
      // TODO - Remove 'is_numeric($divisionSlug)' if not necessary
      $currentDivision = Division::where(is_numeric($divisionSlug) ? 'id' : 'slug', $divisionSlug)->firstOrFail();

      $allDivisions = $navDivisions = Division::all();
      $userMenu = false;

      $threads = $this->getDivisionThreads($currentDivision->id);

      if ($request) {
          $options_query = $request->input('query_term', '');	// (optional) search query
          $size = $request->input('count', 30);
          $page = $request->input('page', 1);
          $page -= 1; // ElasticSearch page numbers start from zero
          if(trim($options_query) != ''){
              $query = [
                  'multi_match' => [
                      'query' => $options_query,
                      'fields' => ['title', 'excerpt', 'keywords']
                  ]
              ];
              $results = Search::queryArticlesByDivision($currentDivision->id, $page, $size, $query);
          } else {
              $results = Search::queryArticlesByDivision($currentDivision->id, $page, $size);
          }
      } else {
          $results = Search::queryArticlesByDivision($currentDivision->id);
      }

      $results_hits = $results['hits'];
      $total_count = $results['total'];

      $articleMediaArray = $this->getArticleMedia($results_hits);
      $newsFeeds = Search::formatElasticSearchToArray($results_hits);

      $item_count = count($newsFeeds);
      $last_page = $size*(1+$page) >= $total_count;
      $options_page = $page + 1;
      $options_count = $size;

      return view('division.index', compact([
        'allDivisions', 'navDivisions', 'currentDivision', 'newsFeeds', 'userMenu', 'articleMediaArray',
        'threads','query_term', 'total_count', 'options_page', 'options_count', 'item_count', 'last_page'
      ]));

    }

    private function getArticleMedia($results_hits) {
        // Gather media for each article retreived
        $articleMediaArray = [];
        foreach ($results_hits as $item){
          $itemMedia = ArticleMedia::where('article_id', $item['_id'])->first();
          if ($itemMedia)
              array_push($articleMediaArray, $itemMedia);
        }
        return $articleMediaArray;
    }

    /**
    * Return current div's discussion threads
    * @param  int   $divID
    * @return array $threads
    * FIXME: Currently the "All Divisions" $divID is the same as the health div
    * However, "All Divisions" should have their own $divID
    */
    private function getDivisionThreads($divID) {
        $threads = [];
        $tempThreads = [];
        $threads[0] = Thread::where('divisions', 'LIKE', '%|'.$divID.'|%')->orderBy('created_at', 'desc')->first();
        $tempThreads = Thread::where('divisions', 'LIKE', '%|'.$divID.'|%')->orderBy('updated_at', 'desc')->get();
        if ($tempThreads[0] = $threads[0]){
          $threads[1]=$tempThreads[1];
        }
        else {
          $threads[1]=$tempThreads[0];
        }

        return $threads;
    }


}
