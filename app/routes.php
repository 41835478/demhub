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

Route::group(array('before' => 'guest'), function() {
	
	/*
	| Cross site Restrict Forgery Group
	*/
	Route::group( array('before' => 'csrf'),function(){
			/*
			| Post guest form
			*/
			Route::post('sign-up', array(
										'as' => 'sign-up',
										'uses' => 'AuthController@sign_up'
										));
			Route::post('login', array(
										'as' => 'login',
										'uses' => 'AuthController@login'
										));
	});
	
	Route::get('/', array(
					'as' => 'home',
					'uses' => 'HomeController@showWelcome'
					));
	Route::get('privacy_policy', array(
					'as' => 'privacy_policy',
					'uses' => 'HomeController@showPrivacyPolicy'
					));
	
	Route::get('terms_of_service', array(
					'as' => 'terms_of_service',
					'uses' => 'HomeController@showTOS'
									));
	
	Route::get('division/{id}', array(
								'as'	=> 'division',
								'uses'	=> 'XmlController@division'
								));

	Route::get('sign-up', array(
							'as' => 'sign-up',
							'uses' => 'AuthController@sign_up'
							));
							
	Route::get('login', array(
							'as' => 'login',
							'uses' => 'AuthController@login'
							));
	Route::get('linkedin', array(
								'as' => 'linkedin-login',
								'uses'	=> 'AuthController@loginWithLinkedin'
							));
					
	Route::get("twitter", array(
								'as' => 'twitter-login',
								'uses' => 'AuthController@loginWithTwitter'
								));
	
	Route::get('google-redirect', array(
									'as' => 'google-login',
									'uses' => 'AuthController@loginWithGoogle'
									));	

	Route::get('discover', array(
								'as'	=> 'discover',
								'uses'	=> 'HomeController@discoverFeeds'
								));

	Route::get('xml', array(
							'as' 		=> 'xml',
							'uses'		=> 'XmlController@xml'
							));
	Route::get('update-feed', array(
								'as'	=> 'update-feeds',
								'uses'	=> 'HomeController@updateFeeds'
								));
});
if (Auth::check()){
	Route::group(array('before' => 'auth'), function() {
					/*
			| Cross site Restrict Forgery Group
			*/
		Route::group( array('before' => 'csrf'),function(){
			Route::post(''.Auth::user()->user_name.'/settings', array(
								'as' 	=> 'user-settings',
								'uses' 	=> 'AuthController@settingsUser'
								));
			Route::post('create', array(
								'as' 	=> 'create',
								'uses' 	=> 'AppController@createApp'
								));

			Route::post('app/settings/{id}', array(
										'as' 	=> 'app-settings',
										'uses'	=> 'AppController@appSettings'
										));
			Route::post('upload', array(
								'as'	=> 'upload',
								'uses'	=> 'FilesController@uploadFiles'
								));
			Route::post('comment/{id}', array(
								'as'	=> 'comment',
								'uses'	=> 'CommentsController@commentItem'
								));
			Route::post('share/{id}', array(
								'as'	=> 'share',
								'uses'	=> 'FilesController@shareFile'
								));

			Route::post('post-discussion', array(
								'as'	=> 'post-discussion',
								'uses'	=> 'DiscussionController@postDiscussion'
								));
			Route::post('post-reply/{id}', array(
								'as'	=> 'post-reply',
								'uses'	=> 'DiscussionController@postReply'
								));

			
		});

							
	

	Route::get('update-feed', array(
							'as'	=> 'update-feeds',
							'uses'	=> 'HomeController@updateFeeds'
							));
	Route::get('/', array(
						'as' 	=> 'home',
						'uses' 	=> 'HomeController@showUserWelcome'
						));

	Route::get('home', array(
						'as'	=> 'main-home',
						'uses'	=> 'HomeController@showHomePage'
						));

	Route::get('division/{id}', array(
								'as'	=> 'division',
								'uses'	=> 'XmlController@division'
								));

	
	Route::get('arrange-likes', array(
						'as' 	=> 'arrange-likes',
						'uses' 	=> 'HomeController@showUserWelcome_ArrangeByLikes'
						));
	
	Route::get('arrange-dislikes', array(
					'as' 	=> 'arrange-dislikes',
					'uses' 	=> 'HomeController@showUserWelcome_ArrangeByDislikes'
					));
			
	Route::get('arrange-comments', array(
					'as' 	=> 'arrange-comments',
					'uses' 	=> 'HomeController@showUserWelcome_ArrangeByComments'
					));
			
						
	Route::get('logout', array(
							'as' 	=> 'logout',
							'uses'	=> 'AuthController@logoutUser'
							));

	Route::get(''.Auth::user()->user_name.'/settings', array(
							'as' 	=> 'user-settings',
							'uses' 	=> 'AuthController@settingsUser'
							));

	Route::get('follow/feed/{id}', array(
									'as'	=> 'follow-feed',
									'uses'	=> 'HomeController@followFeed'
									));

	Route::get('discover', array(
							'as'	=> 'discover',
							'uses'	=> 'HomeController@discoverFeeds'
							));
	Route::get('discussion', array(
						'as'	=> 'discussion',
						'uses'	=> 'HomeController@discussion'
						));
	Route::get('discussion/{id}', array(
								'as'	=> 'discussion-convo',
								'uses'	=> 'DiscussionController@showDiscussion'
								));
	Route::get('filesmanager', array(
							'as'	=> 'files-manager',
							'uses'	=> 'FilesController@filesManager'
							));
	Route::get('feedback', array(
							'as'	=> 'feed-back',
							'uses'	=> 'FilesController@userFeedback'
							));
	Route::get('like/item/{id}', array(
									'as'	=> 'like',
									'uses'	=>	'LikeController@likeItem'
									));
	Route::get('dislike/item/{id}', array(
									'as'	=> 'dislike',
									'uses'	=> 'LikeController@dislikeItem'
									));
	Route::get('comment/{id}', array(
								'as'	=> 'comment',
								'uses'	=> 'CommentsController@commentItem'
								));
	Route::get('share/{id}', array(
								'as'	=> 'share',
								'uses'	=> 'FilesController@shareFile'
								));
	Route::get('search', array(
								'as'	=> 'search',
								'uses'	=> 'SearchController@searchTerm'
								));


	});
}					