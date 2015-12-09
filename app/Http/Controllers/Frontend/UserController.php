<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\ArticleMedia;
use Es;
use Config;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class UserController extends Controller {

	/**
	 * User Homepage
	 */
	public function index(Request $request){
		// FIXME avoid duplication with Division Controller
		$currentDivision = Division::find(1);
		$currentDivision->slug      = "all";
		$currentDivision->name      = "All Divisions";
		$currentDivision->id        = 0;

		$allDivisions = $navDivisions = Division::all();

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

    return view('frontend.user.userhome', compact([
      'allDivisions', 'navDivisions', 'currentDivision', 'newsFeeds', 'query_term', 'articleMediaArray',
			'total_count', 'options_page', 'options_count', 'item_count', 'last_page'
    ]));

	}

	private function getArticleMedia($results_hits) {
		// FIXME avoid duplication with Division Controller
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
			// FIXME avoid duplication with Division Controller
        $newsFeeds = [];
        foreach ($results_hits as $item){
          array_push($newsFeeds, $item['_source']);
        }
        return $newsFeeds;
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
			// FIXME avoid duplication with Division Controller
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
			// FIXME avoid duplication with Division Controller
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
        if ($divID > 0 && $divID < 7) {
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
			// dd($params);
      return Es::search($params);
    }
}
