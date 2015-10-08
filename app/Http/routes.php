<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['before' => 'guest'], function() {

	/*
	| Cross site Restrict Forgery Group
	*/

	Route::post('sign-up', [
		'as' => 'sign-up',
		'uses' => 'Auth\AuthController@sign_up'
	]);

	Route::post('login', [
		'as' => 'login',
		'uses' => 'Auth\AuthController@login'
	]);

	Route::get('/', [
		'as' => 'home',
		'uses' => 'HomeController@showWelcome'
	]);

	Route::get('auto-login', [
		'as' => 'auto-login',
		'uses' => 'HomeController@showAutoLogin'
	]);

	Route::get('privacy_policy', [
		'as' => 'privacy_policy',
		'uses' => 'HomeController@showPrivacyPolicy'
	]);

	Route::get('terms_of_service', [
		'as' => 'terms_of_service',
		'uses' => 'HomeController@showTOS'
	]);

	Route::get('signUpSuccess', [
		'as' => 'signUpSuccess',
		'uses' => 'HomeController@showSignUpSuccess'
	]);

	Route::get('admin-panel', [
		'as' => 'admin-panel',
		'uses' => 'HomeController@showAdminPanel'
	]);

	Route::get('about-us', [
		'as' => 'about-us',
		'uses' => 'HomeController@showAboutUs'
	]);

	Route::get('signUpSuccess', [
		'as' => 'signUpSuccess',
		'uses' => 'HomeController@showSignUpSuccess'
	]);

	Route::get('admin-panel', [
		'as' => 'admin-panel',
		'uses' => 'HomeController@showAdminPanel'
	]);

	Route::get('resource-list', [
		'as' => 'resource-list',
		'uses' => 'HomeController@showResourceList'
	]);

	Route::get('division/{id}', [
		'as'	=> 'division',
		'uses'	=> 'XmlController@division'
	]);

	Route::get('sign-up', [
		'as' => 'sign-up',
		'uses' => 'Auth\AuthController@sign_up'
	]);

	Route::get('login', [
		'as' => 'login',
		'uses' => 'Auth\AuthController@login'
	]);

	Route::get('linkedin', [
		'as' => 'linkedin-login',
		'uses'	=> 'Auth\AuthController@loginWithLinkedin'
	]);

	Route::get("twitter", [
		'as' => 'twitter-login',
		'uses' => 'Auth\AuthController@loginWithTwitter'
	]);

	Route::get('google-redirect', [
		'as' => 'google-login',
		'uses' => 'Auth\AuthController@loginWithGoogle'
	]);

	Route::get('discover', [
		'as'	=> 'discover',
		'uses'	=> 'HomeController@discoverFeeds'
	]);

	Route::get('xml', [
		'as' 		=> 'xml',
		'uses'		=> 'XmlController@xml'
	]);

	Route::get('update-feed', [
		'as'	=> 'update-feeds',
		'uses'	=> 'HomeController@updateFeeds'
	]);

});

Route::get('resource-filter', [
	'as' => 'resource-filter',
	'uses' => 'HomeController@showResourceFilter'
]);

if (Auth::check()) {

	Route::group(array('before' => 'auth'), function() {

		/*
		| Cross site Restrict Forgery Group
		*/

		Route::post(Auth::user()->user_name.'/settings', [
			'as' 	=> 'user-settings',
			'uses' 	=> 'Auth\AuthController@settingsUser'
		]);

		Route::post('create', [
			'as' 	=> 'create',
			'uses' 	=> 'AppController@createApp'
		]);

		Route::post('app/settings/{id}', [
			'as' 	=> 'app-settings',
			'uses'	=> 'AppController@appSettings'
		]);

		Route::post('upload', [
			'as'	=> 'upload',
			'uses'	=> 'FilesController@uploadFiles'
		]);

		Route::post('comment/{id}', [
			'as'	=> 'comment',
			'uses'	=> 'CommentsController@commentItem'
		]);

		Route::post('share/{id}', [
			'as'	=> 'share',
			'uses'	=> 'FilesController@shareFile'
		]);

		Route::post('post-discussion', [
			'as'	=> 'post-discussion',
			'uses'	=> 'DiscussionController@postDiscussion'
		]);

		Route::post('post-reply/{id}', [
			'as'	=> 'post-reply',
			'uses'	=> 'DiscussionController@postReply'
		]);

		Route::get('events', [
			'as' => 'events',
			'uses' => 'HomeController@showEvents'
		]);

		Route::get('media', [
			'as' => 'media',
			'uses' => 'HomeController@showMedia'
		]);

		Route::get('profile', [
			'as' => 'profile',
			'uses' => 'HomeController@showProfile'
		]);

		Route::get('update-feed', [
			'as'	=> 'update-feeds',
			'uses'	=> 'HomeController@updateFeeds'
		]);

		Route::get('/', [
			'as' 	=> 'welcome',
			'uses' 	=> 'HomeController@showUserWelcome'
		]);

		Route::get('home', [
			'as'	=> 'home',
			'uses'	=> 'HomeController@showHomePage'
		]);

		Route::get('division/{id}', [
			'as'	=> 'division',
			'uses'	=> 'XmlController@division'
		]);

		Route::get('arrange-likes', [
			'as' 	=> 'arrange-likes',
			'uses' 	=> 'HomeController@showUserWelcome_ArrangeByLikes'
		]);

		Route::get('arrange-dislikes', [
			'as' 	=> 'arrange-dislikes',
			'uses' 	=> 'HomeController@showUserWelcome_ArrangeByDislikes'
		]);

		Route::get('arrange-comments', [
			'as' 	=> 'arrange-comments',
			'uses' 	=> 'HomeController@showUserWelcome_ArrangeByComments'
		]);

		Route::get('logout', [
			'as' 	=> 'logout',
			'uses'	=> 'Auth\AuthController@logoutUser'
		]);

		Route::get(''.Auth::user()->user_name.'/settings', [
			'as' 	=> 'user-settings',
			'uses' 	=> 'Auth\AuthController@settingsUser'
		]);

		Route::get('follow/feed/{id}', [
			'as'	=> 'follow-feed',
			'uses'	=> 'HomeController@followFeed'
		]);

		Route::get('discover', [
			'as'	=> 'discover',
			'uses'	=> 'HomeController@discoverFeeds'
		]);

		Route::get('discussion', [
			'as'	=> 'discussion',
			'uses'	=> 'HomeController@discussion'
		]);

		Route::get('discussion/{id}', [
			'as'	=> 'discussion-convo',
			'uses'	=> 'DiscussionController@showDiscussion'
		]);

		Route::get('filesmanager', [
			'as'	=> 'files-manager',
			'uses'	=> 'FilesController@filesManager'
		]);

		Route::get('feedback', [
			'as'	=> 'feed-back',
			'uses'	=> 'FilesController@userFeedback'
		]);

		Route::get('like/item/{id}', [
			'as'	=> 'like',
			'uses'	=>	'LikeController@likeItem'
		]);

		Route::get('dislike/item/{id}', [
			'as'	=> 'dislike',
			'uses'	=> 'LikeController@dislikeItem'
		]);

		Route::get('comment/{id}', [
			'as'	=> 'comment',
			'uses'	=> 'CommentsController@commentItem'
		]);

		Route::get('share/{id}', [
			'as'	=> 'share',
			'uses'	=> 'FilesController@shareFile'
		]);

		Route::get('search', [
			'as'	=> 'search',
			'uses'	=> 'SearchController@searchTerm'
		]);

	});
}
