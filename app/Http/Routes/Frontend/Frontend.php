<?php

/**
 * Frontend Controllers
 */
get('/', 'FrontendController@index')->name('home');
get('macros', 'FrontendController@macros');
get('about', 'FrontendController@about');
get('policy', 'FrontendController@policy');
get('terms', 'FrontendController@terms');
get('forum/all_threads', 'ForumController@getViewAllThreads')->name('all_threads');
get('forum/9-/thread/create', 'ForumController@getModCreateThread');
post('forum/9-/thread/create', 'ForumController@postModCreateThread');
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
get('publications', 'PublicationController@index')->name('publications');
get('publication/new', 'PublicationController@create')->name('new_publication');
post('publication/store', 'PublicationController@store')->name('store_publication');
get('publication/{id}/edit', 'PublicationController@edit')->name('show_publication');
patch('publication/update', 'PublicationController@update')->name('update_publication');

/**
 * These frontend controllers require the user to be logged in
 */
$router->group(['middleware' => 'auth'], function ()
{
	get('userhome', 'UserController@index')->name('userhome');
	get('discussion', 'ForumController@showDiscussionIndex')->name('discussion');
	get('dashboard', 'DashboardController@index')->name('dashboard');
	// get('profile/edit', 'ProfileController@edit')->name('edit_profile');
	patch('profile/update', 'ProfileController@update')->name('update_profile');
});

/**
 * Scheduler routes
 *
 */
get('scheduler/initialize', 'SchedulerController@initialize');
get('scheduler/toolbox', 'SchedulerController@toolbox');
get('scheduler/scrapeRss', 'SchedulerController@scrapeRss');
