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

get('forum/all_threads', 'ForumController@getViewAllThreads')->name('all_threads');
get('forum/9-/thread/create', 'ForumController@getModCreateThread');
post('forum/9-/thread/create', 'ForumController@postModCreateThread');

get('feedback', 'FrontendController@getFeedback');
post('feedback', 'FrontendController@postFeedback')->name('post_feedback');
// get('auth/register/{provider}', 'AuthController@getRegister')->name('register');

/**
 * Division Routes
 * Namespaces indicate folder structure
 * TODO - Implement folder structure
 */
get('divisions', 'DivisionController@index');
get('division/{slug}', 'DivisionController@show')->where('slug', '[A-Za-z_\-]+');
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
 * Publication Routes
 */
// resource('publication', 'PublicationController');
get('my_publications', 'PublicationController@index')->name('my_publications');
get('my_publication/new', 'PublicationController@create')->name('new_publication');
post('my_publication/store', 'PublicationController@store')->name('store_publication');
get('my_publication/{id}/edit', 'PublicationController@edit')->name('edit_publication');
patch('my_publication/{id}', 'PublicationController@update')->name('update_publication');
get('my_publication/{id}', 'PublicationController@show')->name('show_publication');

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
