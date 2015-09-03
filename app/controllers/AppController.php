<?php 
class AppController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default App Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'AppController@');
	|
	*/
	
	
	public function createApp() {
		if (Request::isMethod('get')) {
			return View::make('user.app.create')->with('action', URL::route('create'));
		}
		else {
			$inputs = array(
							'name' 			=> Input::get('name'),
							'description' 	=> Input::get('description'),
							);
							
			$validate = Validator::make($inputs, array(
													'name'			=> 'required|min:3|max:100',
													'description'	=> 'min:5|max:400'
													));
			if ($validate->fails()) {
				return Redirect::route('create')->withInput(Input::all())
												->withErrors($validate->messages());	
				
			}
			else {
				$public = false;
				if (Input::get('public')){
					$public = true;	
				}
				
				$create = Cerialapp::create(array(
											'app_name' 		=> Input::get('name'),
											'app_desc'			=> Input::get('description'),
											'app_user_id'		=> Auth::user()->id,
											'app_public'		=> $public,
											'app_url'			=> Str::random($length = 5),
											'app_configured' 	=> false,
											'updated_at'		=> $app('currentDT'),
											'created_at' 		=> $app('currentDT')
											));
				$appid = $create->id;
				$settings = Cerialappsettings::create(array(
												'app_id' 			=> $appid,
												'app_board'		=> 1,
												'app_key'			=> Str::random($length = 60),
												'app_secret'		=> Str::random($length = 60),
												'app_configured' 	=> 0,
												'updated_at'		=> app('currentDT'),
												'created_at' 		=> app('currentDT')	
												));
				
				return Redirect::route('home');
				
				
			}
										
		}
	}
	
	public function appSettings($id) {
		$apps = Auth::user()->apps;
		$ownuser = false;

		foreach ($apps as $key => $value) {
			# code...
			
			if ($value->id == $id){
				$ownuser = true;
			}
		}

		if ($ownuser){
			$app = Cerialapp::where('apps.id', '=', $id)
						->join('users as user', 'apps.app_user_id' , '=', 'user.id')
						->join('apps_settings as settings', 'apps.id', '=', 'settings.app_id')
						->join('apps_board as board', 'settings.app_board', '=', 'board.id')
						->join('app_code as code', 'board.id', '=', 'code.board_id')
						->first();
			$boards = IotBoard::orderBy('id', 'asc')
								->get();
			$analogInputs = AnalogInputs::orderBy('id', 'asc')
										->get();

			$digitalInputs = DigitalInputs::orderBy('id', 'asc')
											->get();

			$communicationInputs = CommunicationInputs::orderBy('id', 'asc')
														->get();							
			
			if (Request::isMethod('get')) {
				return View::make('user.app.edit-settings')->with('userapp', $app)
														->with('action', URL::route('app-settings'))
														->with('boards', $boards)
														->with('analogInputs', $analogInputs)
														->with('digitalInputs', $digitalInputs)
														->with('communicationInputs', $communicationInputs);	
			}
			else {

			}
		}
		else {
			$app = Cerialapp::where('apps.id', '=', $id)
						->join('users as user', 'apps.app_user_id' , '=', 'user.id')
						->join('apps_settings as settings', 'apps.id', '=', 'settings.app_id')
						->join('apps_board as board', 'settings.app_board', '=', 'board.id')
						->join('app_code as code', 'board.id', '=', 'code.board_id')
						->first();
	
			return View::make('user.app.settings')->with('userapp', $app);	

		}
	}

	public function manageApps() {
		
		$apps = Cerialapp::where('app_user_id', '=', Auth::user()->id)
					->orderBy('created_at', 'desc')
					->get();
					
		return View::make('user.app.manage')->with('apps', $apps);
	}

	public function discoverApps(){
			
		$apps = Cerialapp::where('app_public','=', true)
						->where('app_configured', '=', true)
						->with('user')
						->with(array('likes' => function($query){
								$query->where('hidden', '=', false);
							}))
						->with(array('favourites' => function($query){
								$query->where('hidden', '=', false);
							}))
						->get();

		return View::make('discover.index')->with('apps', $apps);
	}

	/**************Like***************/
	public function likeApp($id){
		$like = Likes::where('apps_id', '=', $id)
					->where('user_id', '=', Auth::user()->id)
					->first();
		if ($like == null) {
			$like_created = Likes::create(array(
								'apps_id'		=> $id,
								'user_id'		=> Auth::user()->id,
								'updated_at'	=> app('currentDT'),
								'created_at'	=> app('currentDT')
							));
		}
		else {
			if (!$like->hidden){
				$like->hidden = true;
				$like->save();
			}
			else {
				$like->hidden = false;
				$like->save();	
			}
		}
		return Redirect::route('discover');
	}

	/**********************************/

		/***************Liked Apps**************/
		public function likedApps(){
			$likedapps = Likes::where('hidden','=', false)
								->where('user_id', '=', Auth::user()->id)
								->with('getLikedApp')
								->with('getLikedAppUser')
								->join('apps as app', 'likes.apps_id', '=', 'app.id')
								->join('avatar as user_pic', 'app.app_user_id', '=', 'user_pic.avatar_user_id')
								->get();

			return View::make('user.app.likes')->with('likes', $likedapps);	
		}
		/**********************************/

	/**************Favourites***************/

	public function favouriteApp($id){
		$favourite = Favourites::where('apps_id', '=', $id)
					->where('user_id', '=', Auth::user()->id)
					->first();
		if ($favourite == null) {
			$favourite_created = Favourites::create(array(
								'apps_id'		=> $id,
								'user_id'		=> Auth::user()->id,
								'updated_at'	=> app('currentDT'),
								'created_at'	=> app('currentDT')
							));
		}
		else {
			if (!$favourite->hidden){
				$favourite->hidden = true;
				$favourite->save();
			}
			else {
				$favourite->hidden = false;
				$favourite->save();	
			}
		}
		return Redirect::route('discover');
	}

	/**********************************/


		/***************Favourited Apps**************/
		public function favouritedApps(){
			$likedapps = Favourites::where('hidden','=', false)
								->where('user_id', '=', Auth::user()->id)
								->with('getFavouritedApp')
								->with('getFavouritedAppUser')
								->join('apps as app', 'favourites.apps_id', '=', 'app.id')
								->join('avatar as user_pic', 'app.app_user_id', '=', 'user_pic.avatar_user_id')
								->get();
			return View::make('user.app.favourites')->with('favourites', $likedapps);	
		}
		/**********************************/
	
}
?>