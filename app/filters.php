<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	App::singleton('followFeeds', function(){
		$userfollow = new stdClass;
		if (Auth::check()){
			$feed = Followfeed::where('user_id', '=', Auth::user()->id)
								->where('hidden', '=', false)
								->get();
			$userfollow = $feed;
		}
		else {
			$userfollow = null;
		}
		return $userfollow;
	});
	$userfollow = App::make('followFeeds');
	View::share('followFeeds', $userfollow);

	//Singleton (global) object -> Get current Date and Time 
	App::singleton('currentDT', function() {
		$dt = new DateTime();
		$dt = $dt->format('Y-m-d H:i:s');
		
		return $dt;
	});

	//Singleton (global) object -> Get User Avatar 
	App::singleton('user_avatar', function(){
		$userimage = new stdClass;
		if (Auth::check()){
			$avatar = Avatar::where('avatar_user_id', '=', Auth::user()->id)
							->first();
			$userimage->image = $avatar->file_name;
		}
		else {
			$userimage->image = null;
		}
		return $userimage;
	});
	$user_avatar = App::make('user_avatar');
	View::share('user_avatar', $user_avatar);

	//Singleton (global) object -> Get User is logged in
	App::singleton('auth_check', function() {
		$app = new stdClass;
		if (Auth::check()){
			$app->isLoggedIn = TRUE;
		}
		else {
			$app->isLoggedIn = FALSE;
		}
		return $app;
	});

	//Share it with Views
	$app = App::make('auth_check');
	View::share('auth_check', $app);

	App::singleton('rss', function(){
		$app = new Illuminate\Container\Container;
		$document = new Orchestra\Parser\Xml\Document($app);
		$reader = new Orchestra\Parser\Xml\Reader($document);

		return $reader;
	});
	
});

// App::missing(function($exception)
// {
//     return Response::view('errors.missing', array(), 404);
// });


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
