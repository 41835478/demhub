<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Components\Search;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articleResults = Search::queryArticles();
        $articleResults = Search::formatElasticSearchToArray($articleResults['hits']);
        
        $userResults = Search::queryUsers();
        $userResults = Search::formatElasticSearchToArray($userResults['hits']);
        $userResults = [];

        $publicationResults = Search::queryPublications();
        $publicationResults = Search::formatElasticSearchToArray($publicationResults['hits']);
        $publicationResults = [];

        $discussionResults = Search::queryDiscussions();
        $discussionResults = Search::formatElasticSearchToArray($discussionResults['hits']);
        $discussionResults = [];

        $resourceResults = Search::queryResources();
        $resourceResults = Search::formatElasticSearchToArray($resourceResults['hits']);
        $resourceResults = [];

        return view('frontend.search.index', compact([
          'articleResults', 'userResults', 'publicationResults', 'discussionResults', 'resourceResults'
        ]));
    }
}
