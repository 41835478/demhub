<?php

class DiscussionController extends BaseController {

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
			$title = Input::get('title');
			$description = Input::get('description');
			$category = Input::get('category');
			$discussion = new Conversation;
			$discussion->user_id = Auth::user()->id;
			$discussion->xml_category_feed_id = $category;
			$discussion->discussion_title = $title;
			$discussion->discussion_paragraph = $description;
			$discussion->hidden = false;
			$discussion->updated_at = app('currentDT');
			$discussion->created_at = app('currentDT');
			$discussion->save();

			return Redirect::route('discussion');

		}
		else {
			return Redirect::route('home');
		}
	}

	public function showDiscussion($id){
		$discussion = Conversation::where('id', '=', $id)
									->first();
		if ($discussion){
			return View::make('discussion.view')
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
			$reply_create->reply_paragraph = Input::get('reply');
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
