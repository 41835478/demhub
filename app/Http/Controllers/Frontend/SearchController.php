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
        $queryTerm  = $request->input('query_term', '');    // (optional) search query
        $scope      = $request->input('scope', '');     	// (optional) search query

        $size = $request->input('count', 30);
        $page = $request->input('page', 1);
        $page--;

        $articleScope = $userScope = $publicationScope = $discussionScope = $resourceScope = false;
        switch ($scope) {
            case 'articles':
                $articleScope = true;
                break;

            case 'users':
                $userScope = true;
                break;

            case 'publications':
                $publicationScope = true;
                break;

            case 'discussions':
                $discussionScope = true;
                break;

            case 'resources':
                $resourceScope = true;
                break;

            case 'all':
                $articleScope = $userScope = $publicationScope = $discussionScope = $resourceScope = true;
                break;

            default:
                $articleScope = $userScope = $publicationScope = $discussionScope = $resourceScope = true;
        }

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

            $articleResults     = $articleScope     ? Search::queryArticles($page, $size, $articleQuery)            : NULL;
            $userResults        = $userScope        ? Search::queryUsers($page, $size, $userQuery)                  : NULL;
            $publicationResults = $publicationScope ? Search::queryPublications($page, $size, $publicationQuery)    : NULL;
            $discussionResults  = $discussionScope  ? Search::queryDiscussions($page, $size, $discussionQuery)      : NULL;
            $resourceResults    = $resourceScope    ? Search::queryResources($page, $size, $resourceQuery)          : NULL;
        } else {
            $articleResults     = $articleScope     ? Search::queryArticles($page, $size)       : NULL;
            $userResults        = $userScope        ? Search::queryUsers($page, $size)          : NULL;
            $publicationResults = $publicationScope ? Search::queryPublications($page, $size)   : NULL;
            $discussionResults  = $discussionScope  ? Search::queryDiscussions($page, $size)    : NULL;
            $resourceResults    = $resourceScope    ? Search::queryResources($page, $size)      : NULL;
        }

        $articleTotalCount      = $articleScope     ? $articleResults['total']      : 0;
        $userTotalCount         = $userScope        ? $userResults['total']         : 0;
        $publicationTotalCount  = $publicationScope ? $publicationResults['total']  : 0;
        $discussionTotalCount   = $discussionScope  ? $discussionResults['total']   : 0;
        $resourceTotalCount     = $resourceScope    ? $resourceResults['total']     : 0;

        $articleResults     = $articleScope     ? Search::formatElasticSearchToArray($articleResults['hits'])       : NULL;
        $userResults        = $userScope        ? Search::formatElasticSearchToArray($userResults['hits'])          : NULL;
        $publicationResults = $publicationScope ? Search::formatElasticSearchToArray($publicationResults['hits'])   : NULL;
        $discussionResults  = $discussionScope  ? Search::formatElasticSearchToArray($discussionResults['hits'])    : NULL;
        $resourceResults    = $resourceScope    ? Search::formatElasticSearchToArray($resourceResults['hits'])      : NULL;

        $searchBar = true;

        return view('frontend.search.index', compact([
          'articleResults', 'userResults', 'publicationResults', 'discussionResults', 'resourceResults',
          'articleTotalCount', 'userTotalCount', 'publicationTotalCount', 'discussionTotalCount', 'resourceTotalCount',
          'searchBar', 'queryTerm'
        ]));
    }
}
