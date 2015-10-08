<?php

namespace DEMHub\Http\Controllers;

use Illuminate\Http\Request;
use DEMHub\Http\Requests;
use DEMHub\Http\Controllers\Controller;

class LikeController extends Controller {

	public function likeItem($id){
		$like = Likes::where('user_id', '=', Auth::user()->id)
					->where('feed_id', '=', $id)
					->first();

		$likecount = Likescount::where('feed_id', '=', $id)
								->first();
		$change = false;
		if ($like && !$like->hidden){
			$update = Likes::find($like->id);
			$update->hidden = true;
			$change = true;
			$update->save();
		}
		elseif ($like && $like->hidden) {
			$update = Likes::find($like->id);
			$update->hidden = false;
			$update->save();
		}
		else {
			$create = new Likes;
			$create->user_id = Auth::user()->id;
			$create->feed_id = $id;
			$hidden = false;
			$create->save();
		}

		if ($likecount){
			if ($change){
				if ($likecount->count == 0){
					$likecount->count = 0;
					$likecount->save();
				}
				else {
					$likecount->count =  $likecount->count - 1;
					$likecount->save();
				}
			}
			else {
				$likecount->count =  $likecount->count + 1;
				$likecount->save();
			}
		}
		else {
			$likecount_create = new Likescount;
			$likecount_create->feed_id = $id;
			$likecount_create->count = $likecount_create->count + 1;
			$likecount_create->hidden = false;
			$likecount_create->save();
		}

		return Redirect::back();
	}

	public function dislikeItem($id){
		$dislike = Dislikes::where('user_id', '=', Auth::user()->id)
					->where('xml_category_feed_id', '=', $id)
					->first();
		$dislikecount = Dislikescount::where('feed_id', '=', $id)
								->first();
		$change = false;

		if ($dislike && !$dislike->hidden){
			$update = Dislikes::find($dislike->id);
			$update->hidden = true;
			$update->save();
			$change = true;
		}
		elseif ($dislike && $dislike->hidden) {
			$update = Dislikes::find($dislike->id);
			$update->hidden = false;
			$update->save();
		}
		else {
			$create = new Dislikes;
			$create->user_id = Auth::user()->id;
			$create->xml_category_feed_id = $id;
			$hidden = false;
			$create->save();
		}
		if ($dislikecount){
			if ($change){
				if ($dislikecount->count == 0){
					$dislikecount->count = 0;
					$dislikecount->save();
				}
				else {
					$dislikecount->count =  $dislikecount->count - 1;
					$dislikecount->save();
				}
			}
			else {
				$dislikecount->count =  $dislikecount->count + 1;
				$dislikecount->save();
			}
		}
		else {
			$dislikecount_create = new Dislikescount;
			$dislikecount_create->feed_id = $id;
			$dislikecount_create->count = $dislikecount_create->count + 1;
			$dislikecount_create->hidden = false;
			$dislikecount_create->save();
		}

		return Redirect::back();
	}
}
