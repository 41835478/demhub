<?php

namespace DEMHub\Http\Controllers;

use Illuminate\Http\Request;
use DEMHub\Http\Requests;
use DEMHub\Http\Controllers\Controller;

class DiscussionController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function postDiscussion(){
		if (Request::isMethod('post')){
			$title = Request::input('title');
			$description = Request::input('description');
			$category = Request::input('category');
			$discussion = new Conversation;
			$discussion->user_id = Auth::user()->id;
			$discussion->xml_category_feed_id = $category;
			$discussion->discussion_title = $title;
			$discussion->discussion_paragraph = $description;
			$discussion->hidden = false;
			$discussion->updated_at = app('currentDT');
			$discussion->created_at = app('currentDT');
			$discussion->save();

			return Redirect::url('discussion');

		}
		else {
			return Redirect::url('home');
		}
	}

	public function showDiscussion($id){
		$discussion = Conversation::where('id', '=', $id)
									->first();
		if ($discussion){
			return view('discussion.view')
						->with('discussion', $discussion);
		}
		else {
			return Redirect::back();
		}
	}

	public function postReply($id){
		if (Request::isMethod('post')){
			$reply_create = new Reply;
			$reply_create->user_id = Auth::user()->id;
			$reply_create->conversation_id = $id;
			$reply_create->reply_paragraph = Request::input('reply');
			$reply_create->hidden = false;
			$reply_create->updated_at = app('currentDT');
			$reply_create->updated_at = app('currentDT');
			$reply_create->save();

			$conversation = Conversation::where('id','=',$id)
										->update(array(
												'updated_at' => app('currentDT'),
												));

			return Redirect::back();
		}
		else {

		}
	}

}
