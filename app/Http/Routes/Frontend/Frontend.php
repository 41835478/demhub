<?php

/**
 * Frontend Controllers
 */
get('/', 'FrontendController@index')->name('home');
get('macros', 'FrontendController@macros');
get('about', 'FrontendController@about');
get('policy', 'FrontendController@policy');
get('terms', 'FrontendController@terms');

get('signUpSuccess', 'FrontendController@signUpSuccess')->name('signUpSuccess');

get('forum/all_threads', 'ThreadController@getViewAllThreads')->name('all_threads');
get('forum/9-/thread/create', 'ThreadController@getModCreateThread');
post('forum/9-/thread/create', 'ThreadController@postModCreateThread');

get('feedback', 'FrontendController@getFeedback');
post('feedback', 'FrontendController@postFeedback')->name('post_feedback');
// get('auth/register/{provider}', 'AuthController@getRegister')->name('register');

/**
 * Division Routes
 * Namespaces indicate folder structure
 * TODO - Implement folder structure
 */
get('divisions', 'DivisionController@index');
get('division/{slug}', 'DivisionController@show')->where('slug', '[A-Za-z0-9_\-]+');
get('divisions/results', 'DivisionController@index');
post('divisions/results', 'DivisionController@results');

/**
 * Info Resources Routes
 * Namespaces indicate folder structure
 * TODO - Implement folder structure
*/
get('resource_filter', 'InfoResourceController@showResourceFilter')->name('resource_filter');
get('resources', 'InfoResourceController@index');

/**
 * Public Publication Route
 */
get('public_journal', 'PublicationController@public_publication')->name('publications');
// get('_update_article', 'PublicationController@public_publication')->name('_update_article');

/**
 * These frontend controllers require the user to be logged in
 */
$router->group(['middleware' => 'auth'], function ()
{
	get('userhome', 'UserController@index')->name('userhome');
	get('discussion', 'ForumController@showDiscussionIndex')->name('discussion');
	get('dashboard', 'DashboardController@index')->name('dashboard'); // used instead of edit_profile

	get('dashboardtest', 'DashboardController@test');

	get('connections', 'DashboardController@showConnections')->name('connections');
	// get('profile/edit', 'ProfileController@edit')->name('edit_profile');
	patch('profile/update', 'ProfileController@update')->name('update_profile');

	/**
	 * Publication Routes
	 */
	// resource('publication', 'PublicationController');
	get('my_publications', 'PublicationController@index')->name('my_publications');
	post('my_publications/{caret}', 'PublicationController@caret_publication_action')->name('caret_publication_action');

	get('my_publication/new', 'PublicationController@create')->name('new_publication');
	post('my_publication/store', 'PublicationController@store')->name('store_publication');
	get('my_publication/{id}/edit', 'PublicationController@edit')->name('edit_publication');
	get('publication/{id}/view', 'PublicationController@view')->name('view_publication');
	patch('my_publication/{id}', 'PublicationController@update')->name('update_publication');
	get('publication/{id}', 'PublicationController@preview')->name('preview_publication');

	/**
	 * Public Profiles
	 */
	get('profile/{user_name}', 'ProfileController@view_public_profile')->name('view_public_profile');
	get('profiles', 'ProfileController@listing_of_profiles')->name('profiles');

	/**
	 * Search
	 */
	get('search', 'SearchController@index')->name('search');

	// Follow/unfollow
	post('follow/{id}', 'ProfileController@followUser')->name('follow_user');
	post('unfollow/{id}', 'ProfileController@unfollowUser')->name('unfollow_user');
});

/**
 * Scheduler routes
 */
get('scheduler/scrapeRSS', 'SchedulerController@scrapeRSS');
get('scheduler/scrapeCustom', 'SchedulerController@scrapeCustom');
get('scheduler/initialize', 'SchedulerController@initialize');
get('scheduler/toolbox', 'SchedulerController@toolbox');
//deprecated
get('scheduler/scrapeIRDR', 'SchedulerController@scrapeIRDR');
get('scheduler/scrapeEC', 'SchedulerController@scrapeEC');

/**
 * Articles routes
 */
get('article/browse', 'ArticleController@browse');
get('article/stream', 'ArticleController@stream');
get('article/report', 'ArticleController@report');
