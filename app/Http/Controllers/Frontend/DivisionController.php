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
use Es;
use Config;

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
      $currentDivision->id        = 0;

      $allDivisions = $navDivisions = Division::all();
      $userMenu = false;

      $threads = $this->getDivisionThreads($currentDivision->id);

      if ($request) {
          $query = [
            "match_all" => []
          ];
          $options_query = $request->input('query_term', '');	// (optional) search query
          if(trim($options_query) != ''){
              $query = [
                  'multi_match' => [
                      'query' => $options_query,
                      'fields' => ['title', 'excerpt', 'keywords']
                  ]
              ];
          }
          $size = $request->input('count', 30);
          $page = $request->input('page', 1);
          $page -= 1;

          $results = $this->elasticSearchResults($query, $size, $page, $currentDivision->id);
      } else {
          $results = $this->defaultElasticResults($currentDivision->id);
      }

      $results_hits = $results['hits']['hits'];
      $articleMediaArray = $this->getArticleMedia($results_hits);
      $newsFeeds = $this->formatNewsFeed($results_hits);

      $total_count = $results['hits']['total'];
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
      if (is_numeric($divisionSlug)){
          $currentDivision = Division::where('id', $divisionSlug)->firstOrFail();
      } else {
          $currentDivision = Division::where('slug', $divisionSlug)->firstOrFail();
      }
      $allDivisions = $navDivisions = Division::all();
      $userMenu = false;

      $threads = $this->getDivisionThreads($currentDivision->id);

      if ($request) {
          $query = [
            "match_all" => []
          ];
          $query_term = $request->input('query_term', '');	// (optional) search query
          if(trim($query_term) != ''){
              $query = [
                  'multi_match' => [
                      'query' => $query_term,
                      'fields' => ['title', 'excerpt', 'keywords']
                  ]
              ];
          }
          $size = $request->input('count', 30);
          $page = $request->input('page', 1);
          $page -= 1;

          $results = $this->elasticSearchResults($query, $size, $page, $currentDivision->id);
      } else {
          $results = $this->defaultElasticResults($currentDivision->id);
      }

      $results_hits = $results['hits']['hits'];
      $articleMediaArray = $this->getArticleMedia($results_hits);
      $newsFeeds = $this->formatNewsFeed($results_hits);

      $total_count = $results['hits']['total'];
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

    private function formatNewsFeed($results_hits) {
        $newsFeeds = [];
        foreach ($results_hits as $item){
          array_push($newsFeeds, $item['_source']);
        }
        return $newsFeeds;
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
        $threads[0] = Thread::where('parent_category', $divID)->orderBy('created_at', 'desc')->first();
        $tempThreads = Thread::where('parent_category', $divID)->orderBy('updated_at', 'desc')->get();
        if ($tempThreads[0] = $threads[0]){
          $threads[1]=$tempThreads[1];
        }
        else {
          $threads[1]=$tempThreads[0];
        }

        return $threads;
    }

    /**
    * Perform elasticsearch default search per division
    * @param  array   $filterhgkjhgkjhgkjh
    * @param  string  $querydfsgsdfgdf
    * @param  integer $sizegsdfgsdfg
    * @param  integer $pagedsfgsdfgsdf
    * @return JSON (from elasticSearchResults() function)
    */
    private function defaultElasticResults($divID) {
        $query = [
          "match_all" => []
        ];
        $size = 30;
        $page = 0;

        return $this->elasticSearchResults($query, $size, $page, $divID);
    }

    /**
    * Perform elasticsearch query and return json
    * @param  array   $filter
    * @param  string  $query
    * @param  integer $size
    * @param  integer $page
    * @return JSON
    */
    private function elasticSearchResults($query, $size, $page, $divID) {
        $filter = [
          'and' => [
              ['bool' => [
                'should' => [
                  // the language fields should either be the current locale
                  ['term' => [ 'language' => Config::get('app.locale') ]],
                  // or it should be NULL, which by default is expected to be english
                  ['missing' => [ 'field' => 'language' ]]
                ]
              ]],
              ['term' => ['deleted' => 0]],
          ]
        ];
        if ($divID != 0) {
            // Add the division id as one of the "AND" filters
            array_push($filter['and'],
                ['term' => ['divisions' => $divID]]
            );
        }

        $sort = [
            'publish_date' => [
                'order' => 'desc',
                'missing' => PHP_INT_MAX -1, // fixes json_decode() error
            ]
        ];

      $params = [
          'index' => 'news',
          'type' => 'articles',
          'size' => $size,
          'from' => $size * $page,
          'body' => [
              'query' => [
                  'filtered' => [
                      'filter' => $filter,
                      'query' => $query
                  ]
              ],
              'sort' => $sort
          ]
      ];
      return Es::search($params);
    }
}
