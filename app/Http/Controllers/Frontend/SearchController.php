<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Components\Search;

/**
 * Class SearchController.
 */
class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query_term = $request->input('query_term', '');    // (optional) search query
        $size       = $request->input('count', 30);
        $page       = $request->input('page', 1);
        $scope      = $request->input('scope', 'all');
        $division   = $request->input('division', 'all');
        $db_page = $page - 1;

        $articleResults     = array();
        $userResults        = array();
        $publicationResults = array();
        $discussionResults  = array();
        $resourceResults    = array();

        $divisions = Division::all();
        $div_id = null;
        foreach($divisions as $div){
            if($div->slug == $division)
                $div_id = $div->id;
        }

        if (trim($query_term) != '') {
            $articleQuery = [
                'multi_match' => [
                    'query' => $query_term,
                    'fields' => ['title', 'excerpt', 'keywords', 'source_url'],
                ],
            ];
            $userQuery = [
                'multi_match' => [
                    'query' => $query_term,
                    'fields' => ['first_name', 'last_name', 'email', 'organization_name', 'division', 'specializaiton', 'location'],
                ],
            ];
            $publicationQuery = [
                'multi_match' => [
                    'query' => $query_term,
                    'fields' => ['title', 'description', 'publisher', 'institution', 'conference'],
                ],
            ];
            $discussionQuery = [
                'multi_match' => [
                    'query' => $query_term,
                    'fields' => ['title'],
                ],
            ];
            $resourceQuery = [
                'multi_match' => [
                    'query' => $query_term,
                    'fields' => ['name', 'url', 'country', 'region', 'divisions', 'keywords'],
                ],
            ];

            if ($scope == 'users') {
                $items = Search::queryUsers($db_page, $size, $userQuery, $div_id);
            } elseif ($scope == 'articles') {
                $items = Search::queryArticles($db_page, $size, $articleQuery, $div_id);
            } elseif ($scope == 'publications') {
                $items = Search::queryPublications($db_page, $size, $publicationQuery, $div_id);
            } elseif ($scope == 'discussions') {
                $items = Search::queryDiscussions($db_page, $size, $discussionQuery, $div_id);
            } elseif ($scope == 'resources') {
                $items = Search::queryResources($db_page, $size, $resourceQuery, $div_id);
            }else {
                $articleResults     = Search::queryArticles($db_page, $size, $articleQuery);
                $userResults        = Search::queryUsers($db_page, $size, $userQuery);
                $publicationResults = Search::queryPublications($db_page, $size, $publicationQuery);
                $discussionResults  = Search::queryDiscussions($db_page, $size, $discussionQuery);
                $resourceResults    = Search::queryResources($db_page, $size, $resourceQuery);
            }
        } else {
            $articleResults     = Search::queryArticles($db_page, $size);
            $userResults        = Search::queryUsers($db_page, $size);
            $publicationResults = Search::queryPublications($db_page, $size);
            $discussionResults  = Search::queryDiscussions($db_page, $size);
            $resourceResults    = Search::queryResources($db_page, $size);
        }

        $divisions = $allDivisions = Division::all();
        $searchBar = true;

        if ($scope == 'all' || trim($query_term) == '') {
            $articleTotalCount      = isset($articleResults['total'])       ? $articleResults['total']      : 0;
            $userTotalCount         = isset($userResults['total'])          ? $userResults['total']         : 0;
            $publicationTotalCount  = isset($publicationResults['total'])   ? $publicationResults['total']  : 0;
            $discussionTotalCount   = isset($discussionResults['total'])    ? $discussionResults['total']   : 0;
            $resourceTotalCount     = isset($resourceResults['total'])      ? $resourceResults['total']     : 0;

            $articleResults     = Search::formatElasticSearchToArray($articleResults['hits']);
            $userResults        = Search::formatElasticSearchToArray($userResults['hits']);
            $publicationResults = Search::formatElasticSearchToArray($publicationResults['hits']);
            $discussionResults  = Search::formatElasticSearchToArray($discussionResults['hits']);
            $resourceResults    = Search::formatElasticSearchToArray($resourceResults['hits']);

            return view('frontend.search.index', compact([
                'articleResults', 'userResults', 'publicationResults', 'discussionResults', 'resourceResults',
                'articleTotalCount', 'userTotalCount', 'publicationTotalCount', 'discussionTotalCount', 'resourceTotalCount',
                'searchBar', 'query_term', 'scope', 'allDivisions',
            ]));
        } else {
            //$items     = Search::queryArticles($db_page, $size);
            $totalCount = isset($items['total']) ? $items['total'] : 0;
            $items      = Search::formatElasticSearchToArray($items['hits']);

            return view('frontend.search.results', compact([
                'items', 'totalCount',
                'searchBar', 'query_term', 'scope', 'division', 'divisions', 'page', 'size'
            ]));
        }
    }
}
