<?php

namespace DEMHub\Http\Controllers;

use Illuminate\Http\Request;
use DEMHub\Http\Requests;
use DEMHub\Http\Controllers\Controller;
use DEMHub\Models\User;
use DEMHub\Models\ResourceRelation as ResourceRelation;
use DEMHub\Models\ResourceEntry as ResourceEntry;
use DEMHub\Models\Xmlcategories as Xmlcategories;

class HomeController extends Controller {

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

	public function showWelcome() {
		$categories = Xmlcategories::all();

		return view('guest/welcome')
					->with('action', url("sign-up"))
					->with('xmlcategories', $categories);
	}
	public function showPrivacyPolicy() {

		return view('privacy_policy')
					->with('action', url("sign-up"));

	}
	public function showTOS() {

		return view('terms_of_service')
					->with('action', url("sign-up"));

	}
	public function showAutoLogin() {

		return view('auto-login')
					->with('action', url("auto-login"));

	}
	public function showAdminPanel() {

		return view('admin-panel')
					->with('action', url("admin-panel"));

	}
	public function showSignUpSuccess() {

		return view('signUpSuccess')
					->with('action', url("signUpSuccess"));

	}
	public function showAboutUs() {

		return view('about-us')
					->with('action', url("about-us"));

	}
	public function showHomePage() {
		$categories = Xmlcategories::all();
		return view('user/home')
					->with('action', url("sign-up"))
					->with('xmlcategories', $categories);
	}
	public function showResourceFilter(){
		$resourceRelation= ResourceRelation::all();
		$resourceEntry= ResourceEntry::all();
		$categories = Xmlcategories::all();

		return view('user/resource-filter')
					->with('action', url("resource-filter"))
					->with('xmlcategories', $categories)
					->with('resourceRelation', $resourceRelation)
					->with('resourceEntry', $resourceEntry);

	}
	public function showEvents(){
		$categories = Xmlcategories::all();

		return view('user/events')
			->with('action', url("events"))
			->with('xmlcategories', $categories);
	}
	public function showMedia(){
		$categories = Xmlcategories::all();

		return view('user/media')
			->with('action', url("media"))
			->with('xmlcategories', $categories);
	}
	public function showProfile(){
		$categories = Xmlcategories::all();
		$user=Auth::user();

		return view('user/profile')
			->with('action', url("profile"))
			->with('user', $user)
			->with('xmlcategories', $categories);
	}
	public function showResourceList(){


		// $resourceFilterEntries = ResourceEntry::where('id', '=', $entryIds)
// 							// ->where('hidden', '=', false)
// 							->get();

		return view('user/resource-list')
					->with('action', url("resource-list"));

	}
	public function showUserWelcome(){
		$categories = Xmlcategories::all();
		$feed = Followfeed::where('user_id', '=', Auth::user()->id)
							->where('hidden', '=', false)
							->get();


		return view('user/welcome')
					->with('feeds', $feed)

					->with('xmlcategories', $categories);
	}

	public function showUserWelcome_ArrangeByLikes(){
		$feed = Likescount::orderBy('count', 'desc')
						->where('count','>', 0)
						->get();

		foreach ($feed as $k => $val) {
			# code...
			//echo $val->getFeed;
			//echo $val->getLikes;
		}

		return view('user/arrange')
					->with('feeds', $feed);

	}
	public function showUserWelcome_ArrangeByDislikes(){
		$feed = Dislikescount::orderBy('count', 'desc')
							->get();

		foreach ($feed as $k => $val) {
			# code...
			//echo $val->getFeed;
			//echo $val->getLikes;
		}

		return view('user/arrange')
					->with('feeds', $feed);

	}

	public function showUserWelcome_ArrangeByComments(){
		$feed = Commentscount::orderBy('count', 'desc')
							->get();

		foreach ($feed as $k => $val) {
			# code...
			//echo $val->getFeed;
			//echo $val->getLikes;
		}

		return view('user/arrange')
					->with('feeds', $feed);

	}

	public function discussion() {
		$options = Xmlcategories::all();
		$discussion = Conversation::where('hidden', '=', 'false')
								->orderBy('updated_at', 'desc')
								->paginate(15);


		return view('discussion.index')
					->with('discussions', $discussion)
					->with('categories', $options)
					->with('xmlcategories', $options);
	}

	public function welcomeDivision($id){
		return view('guest/division')->with('id',$id);
	}

	public function discoverFeeds(){

		$category = Xmlcategoryfeed::orderBy('pubDate', 'desc')
									->paginate(20);
		$cat = Xmlcategories::all();
		return view('discover.index')->with('categories', $category)
											->with('xmlcategories', $cat)
											->with('cats', $cat);
		$this->updateFeeds();

	}

	public function followFeed($id){
		$follow = Followfeed::where('category_id', '=', $id)
							->where('user_id', '=', Auth::user()->id)
							->first();

		if (!$follow) {
			$create = Followfeed::create(array(
										'user_id'		=> Auth::user()->id,
										'category_id'	=> $id,
										'hidden'		=> false
									));
		}
		else {
			if (!$follow->hidden){
				$follow->hidden = true;
				$follow->save();
			}
			else {
				$follow->hidden = false;
				$follow->save();
			}
		}

		return Redirect::route('home');
	}

	public function updateFeeds(){
		$category = Xmlcategories::all();


		/****logic to update and store xml feed****/

		$content = array();
		foreach ($category as $cat) {

			foreach ($cat->xmlfeed as $feed) {

				# code...
				if (!$feed->hidden){
					$url = $feed->url;
					$xml=file_get_contents($url);
					//print_r($xml);
					$fd = simplexml_load_string($xml);

					if ($fd){
						$ns=$fd->getNameSpaces(true);

						foreach ($fd->channel->item as $value) {
							# code...
							//push it to a blank array
							$cat_id = array("category_id" => $cat->id);
							array_push($cat_id, $value);
							array_push($content, $cat_id);
							//description
							foreach ($value->description as $val) {
							}
							//keywords
							foreach ($value->category as $val) {
							}
						}

					}
				}
			}
		}

		foreach ($content as $val) {

			# code...
			$origDate = $val[0]->pubDate;
			$newDate = strtotime($origDate);
			//print_r($val[0]->category);



			$update = Xmlcategoryfeed::where('title', '=', $val[0]->title)
									->where('pubDate', '=', $newDate)
									->first();

			if (is_null($update)){
				$create = new Xmlcategoryfeed;
				$create->category_id = $val['category_id'];
				$create->title = $val[0]->title;

				if (is_object($val[0]->link)){
					foreach ($val[0]->link as $lnk) {
						# code...
						$create->link = $lnk;
					}
				}
				else {
					$create->link = $val[0]->link;
				}
				if (is_object($val[0]->description)){
					foreach ($val[0]->description as $descr) {
						# code...
						$create->desc = $descr;
					}
				}
				else {
					$create->desc = $val[0]->description;
				}
				if (is_object($val[0]->category)){
					foreach ($val[0]->category as $va) {
						# code...
						$create->keywords = $va.';';
					}
				}
				else {

					$create->keywords = $val[0]->category;
				}
				$create->pubDate = $newDate;
				$create->save();
			}
			else {

			}
		}
		/****************************/
	}


}
