<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Components\Search;

/**
 * Class SearchController
 * @package App\Http\Controllers\Frontend
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
        $queryTerm  = $request->input('query_term', '');	// (optional) search query
        $scope      = $request->input('scope', '');	// (optional) search query
        
        $size = $request->input('count', 30);
        $page = $request->input('page', 1);
        $page--;

        if(trim($queryTerm) != ''){
            $articleQuery = [
                'multi_match' => [
                    'query' => $queryTerm,
                    'fields' => ['name', 'description', 'keywords', 'url']
                ]
            ];
            $userQuery = [
                'multi_match' => [
                    'query' => $queryTerm,
                    'fields' => ['first_name', 'last_name', 'email', 'organization_name', 'specialization', 'location']
                ]
            ];
            $publicationQuery = [
                'multi_match' => [
                    'query' => $queryTerm,
                    'fields' => ['name', 'description', 'data', 'keywords']
                ]
            ];
            $discussionQuery = [
                'multi_match' => [
                    'query' => $queryTerm,
                    'fields' => ['name']
                ]
            ];
            $resourceQuery = [
                'multi_match' => [
                    'query' => $queryTerm,
                    'fields' => ['name', 'keywords', 'url', 'country', 'state']
                ]
            ];
            $articleResults     = Search::queryArticles($page, $size, $articleQuery);
            $userResults        = Search::queryUsers($page, $size, $userQuery);
            $publicationResults = Search::queryPublications($page, $size, $publicationQuery);
            $discussionResults  = Search::queryDiscussions($page, $size, $discussionQuery);
            $resourceResults    = Search::queryResources($page, $size, $resourceQuery);
        } else {
            $articleResults     = Search::queryArticles($page, $size);
            $userResults        = Search::queryUsers($page, $size);
            $publicationResults = Search::queryPublications($page, $size);
            $discussionResults  = Search::queryDiscussions($page, $size);
            $resourceResults    = Search::queryResources($page, $size);
        }

        $articleTotalCount      = $articleResults['total'];
        $userTotalCount         = $userResults['total'];
        $publicationTotalCount  = $publicationResults['total'];
        $discussionTotalCount   = $discussionResults['total'];
        $resourceTotalCount     = $resourceResults['total'];

        $articleResults     = Search::formatElasticSearchToArray($articleResults['hits']);
        $userResults        = Search::formatElasticSearchToArray($userResults['hits']);
        $publicationResults = Search::formatElasticSearchToArray($publicationResults['hits']);
        $discussionResults  = Search::formatElasticSearchToArray($discussionResults['hits']);
        $resourceResults    = Search::formatElasticSearchToArray($resourceResults['hits']);

        $searchBar = true;

        return view('frontend.search.index', compact([
          'articleResults', 'userResults', 'publicationResults', 'discussionResults','resourceResults',
          'articleTotalCount','userTotalCount','publicationTotalCount','discussionTotalCount','resourceTotalCount',
          'searchBar', 'queryTerm'
        ]));
    }
}
