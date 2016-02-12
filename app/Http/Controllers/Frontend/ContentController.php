<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    // Follower and followed types
	// Including connections, bookmarks, tracking, etc.
	const ARTICLE       = 'A';
	const DIVISION      = 'D';
	const KEYWORD       = 'K';
	const LOCATION      = 'L';
	// const ORGANIZATION  = 'O'; // NOTE - Not yet in use
	const PUBLICATION   = 'P';
	const RESOURCE 		= 'R';
	const SCRAPE_SOURCE = 'S';
	const THREAD        = 'T';
	const USER          = 'U';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getActivityFeed()
    {
        $content = Content::all()->paginate(10);
        $page_data = array(
            'content' => $content
        );

        if (Request::ajax()) {
            return Response::json(View::make('content', $page_data)->render());
        }

        return View::make('content', $page_data);
    }

    // TODO - create alternate function equivalent for
    // ->references('id')->on( {{ followed_type }} )->onDelete('cascade');
    public function bookmarkContent($itemId, $content_type)
    {
        if (!Auth::user()->has_bookmarked_content($itemId, $content_type)) {
            switch ($content_type) {
    			case 'article':
    				$content_type = self::ARTICLE;
    				break;

    			case 'infoResource':
    				$content_type = self::RESOURCE;
    				break;

    			case 'thread':
    				$content_type = self::THREAD;
    				break;

    			case 'publication':
    				$content_type = self::PUBLICATION;
    				break;

    			default:
    				// nothing // this shouldn't happen
    				break;
    		}
            Auth::user()->contentBookmarks()->attach($itemId, [
                'follower_type' => self::USER, 'followed_type' => $content_type,
            ]);
        }

        // TODO - Do this properly
        // $content_json = Helpers::return_json_results($content_json);
        return response()->json([
            'success' => 'cool',
            'message'=> 'Contents rendered',
            'content' => 'blah'
        ]);
    }

    public function unbookmarkContent($itemId, $content_type)
    {
        if (Auth::user()->has_bookmarked_content($itemId, $content_type)) {
            switch ($content_type) {
    			case 'article':
    				$content_type = self::ARTICLE;
    				break;

    			case 'infoResource':
    				$content_type = self::RESOURCE;
    				break;

    			case 'thread':
    				$content_type = self::THREAD;
    				break;

    			case 'publication':
    				$content_type = self::PUBLICATION;
    				break;

    			default:
    				// nothing // this shouldn't happen
    				break;
    		}
            Auth::user()->contentBookmarks()->detach($itemId, [
                'follower_type' => self::USER, 'followed_type' => $content_type,
            ]);
        }

        // TODO - Do this properly
        // $content_json = Helpers::return_json_results($content_json);
        return response()->json([
            'success' => 'cool',
            'message'=> 'Contents rendered',
            'content' => 'blah'
        ]);
    }
}
