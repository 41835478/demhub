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
        $options_query = $request->input('query_term', '');	// (optional) search query
        $size = $request->input('count', 30);
        $page = $request->input('page', 1);
        $page--;

        if(trim($options_query) != ''){
            $articleQuery = [
                'multi_match' => [
                    'query' => $options_query,
                    'fields' => ['title', 'excerpt', 'keywords', 'source_url']
                ]
            ];
            $userQuery = [
                'multi_match' => [
                    'query' => $options_query,
                    'fields' => ['first_name', 'last_name', 'email', 'organization_name', 'division', 'specializaiton', 'location']
                ]
            ];
            $publicationQuery = [
                'multi_match' => [
                    'query' => $options_query,
                    'fields' => ['title', 'description', 'publisher', 'institution', 'conference']
                ]
            ];
            $discussionQuery = [
                'multi_match' => [
                    'query' => $options_query,
                    'fields' => ['title']
                ]
            ];
            $resourceQuery = [
                'multi_match' => [
                    'query' => $options_query,
                    'fields' => ['name', 'url', 'country', 'region', 'divisions', 'keywords']
                ]
            ];
            $articleResults = Search::queryArticles($page, $size, $articleQuery);
            $userResults = Search::queryUsers($page, $size, $userQuery);
            $publicationResults = Search::queryPublications($page, $size, $publicationQuery);
            // $discussionResults = Search::queryDiscussions($page, $size, $discussionQuery);
            $resourceResults = Search::queryResources($page, $size, $resourceQuery);
        } else {
            $articleResults = Search::queryArticles($page, $size);
            $userResults = Search::queryUsers($page, $size);
            $publicationResults = Search::queryPublications($page, $size);
            // $discussionResults = Search::queryDiscussions($page, $size);
            $resourceResults = Search::queryResources($page, $size);
        }

        dd(get_declared_classes());

        $articleResults = Search::formatElasticSearchToArray($articleResults['hits']);
        $userResults = Search::formatElasticSearchToArray($userResults['hits']);
        $publicationResults = Search::formatElasticSearchToArray($publicationResults['hits']);
        // $discussionResults = Search::formatElasticSearchToArray($discussionResults['hits']);
        $resourceResults = Search::formatElasticSearchToArray($resourceResults['hits']);

        $discussionResults = [];
        $searchBar = true;

        return view('frontend.search.index', compact([
          'articleResults', 'userResults', 'publicationResults', 'discussionResults', 'resourceResults', 'searchBar'
        ]));
    }
}
