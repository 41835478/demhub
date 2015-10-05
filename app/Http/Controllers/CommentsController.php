<?php

namespace DEMHub\Http\Controllers;

use Illuminate\Http\Request;
use DEMHub\Http\Requests;
use DEMHub\Http\Controllers\Controller;

class CommentsController extends Controller {

	public function commentItem($id){
		$user_cmt = Request::input('comments');

		$validator = Validator::make(
								array('comment' => Request::input('comments')),
								array('comment'	=> 'required')
						);
		if ($validator->fails()){
			foreach ($validator->messages()->all() as $message){
			    //
			    Session::flash('error', $message);
			}
		}
		else {

			$comment = Comments::create(array(
									'user_id' 				=> Auth::user()->id,
									'xml_category_feed_id' 	=> $id,
									'comment'				=> $user_cmt,
									'hidden'				=> false,
									'updated_at'			=> app('currentDT'),
									'created_at'			=> app('currentDT')
								));
			$comment_create = Commentscount::where('feed_id', '=', $id)
											->first();

			if ($comment_create){
				$comment_create->count = $comment_create->count + 1;
				$comment_create->save();
			}
			else {
				$commentcount_create = new Commentscount;
				$commentcount_create->feed_id = $id;
				$commentcount_create->count = $commentcount_create->count + 1;
				$commentcount_create->hidden = false;
				$commentcount_create->updated_at = app('currentDT');
				$commentcount_create->created_at = app('currentDT');
				$commentcount_create->save();
			}
		}

		return Redirect::back();
	}

}
