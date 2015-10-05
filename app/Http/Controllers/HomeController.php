<?php

class HomeController extends BaseController {

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
		
		return View::make('guest/welcome')
					->with('action', URL::route("sign-up"))
					->with('xmlcategories', $categories);
	}
	public function showPrivacyPolicy() {
		
		return View::make('privacy_policy')
					->with('action', URL::route("sign-up"));
					
	}
	public function showTOS() {
		
		return View::make('terms_of_service')
					->with('action', URL::route("sign-up"));
					
	}
	public function showAutoLogin() {
		
		return View::make('auto-login')
					->with('action', URL::route("auto-login"));
					
	}
	public function showAdminPanel() {
		
		return View::make('admin-panel')
					->with('action', URL::route("admin-panel"));
					
	}
	public function showSignUpSuccess() {
		
		return View::make('signUpSuccess')
					->with('action', URL::route("signUpSuccess"));
					
	}
	public function showAboutUs() {
		
		return View::make('about-us')
					->with('action', URL::route("about-us"));
					
	}
	public function showHomePage() {
		$categories = Xmlcategories::all();
		return View::make('user/home')
					->with('action', URL::route("sign-up"))
					->with('xmlcategories', $categories);
	}
	public function showResourceFilter(){
		$resourceRelation= ResourceRelation::all();
		$resourceEntry= ResourceEntry::all();
		$categories = Xmlcategories::all();
		
		return View::make('user/resource-filter')
					->with('action', URL::route("resource-filter"))
					->with('xmlcategories', $categories)	
					->with('resourceRelation', $resourceRelation)
					->with('resourceEntry', $resourceEntry);
					
	}
	public function showEvents(){
		$categories = Xmlcategories::all();
		
		return View::make('user/events')
			->with('action', URL::route("events"))
			->with('xmlcategories', $categories);
	}
	public function showMedia(){
		$categories = Xmlcategories::all();
		
		return View::make('user/media')
			->with('action', URL::route("media"))
			->with('xmlcategories', $categories);
	}
	public function showProfile(){
		$categories = Xmlcategories::all();
		$user=Auth::user();
		
		return View::make('user/profile')
			->with('action', URL::route("profile"))
			->with('user', $user)
			->with('xmlcategories', $categories);
	}
	public function showResourceList(){
		
		
		// $resourceFilterEntries = ResourceEntry::where('id', '=', $entryIds)
// 							// ->where('hidden', '=', false)
// 							->get();
		
		return View::make('user/resource-list')
					->with('action', URL::route("resource-list"));
					
	}
	public function showUserWelcome(){
		$categories = Xmlcategories::all();
		$feed = Followfeed::where('user_id', '=', Auth::user()->id)
							->where('hidden', '=', false)
							->get();
							

		return View::make('user/welcome')
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

		return View::make('user/arrange')
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

		return View::make('user/arrange')
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

		return View::make('user/arrange')
					->with('feeds', $feed);

	}

	public function discussion() {
		$options = Xmlcategories::all();
		$discussion = Conversation::where('hidden', '=', 'false')
								->orderBy('updated_at', 'desc')
								->paginate(15);
	

		return View::make('discussion.index')
					->with('discussions', $discussion)
					->with('categories', $options)
					->with('xmlcategories', $options);
	}

	public function welcomeDivision($id){
		return View::make('guest/division')->with('id',$id);
	}

	public function discoverFeeds(){
		
		$category = Xmlcategoryfeed::orderBy('pubDate', 'desc')
									->paginate(20);
		$cat = Xmlcategories::all();
		return View::make('discover.index')->with('categories', $category)
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
										'hidden'		=> false,
										'updated_at'	=> app('currentDT'),
										'created_at'	=> app('currentDT')
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
				$create->updated_at = app('currentDT');
				$create->created_at = app('currentDT');
				$create->save();
			}
			else {

			}
		}
		/****************************/
	}


}
