<?php

/**
 * Frontend Controllers
 */
get('/', 'FrontendController@index')->name('home');
get('macros', 'FrontendController@macros');
get('about', 'FrontendController@about');
get('policy', 'FrontendController@policy');
get('terms', 'FrontendController@terms');


/**
 * Division Routes
 * Namespaces indicate folder structure
 * TODO - Implement folder structure
 */
get('divisions', 'DivisionController@index');
get('division/{slug}', 'DivisionController@show')->where('slug', '[A-Za-z_\-]+');

/**
 * Info Resources Routes
 * Namespaces indicate folder structure
 * TODO - Implement folder structure
*/
get('resource_filter', 'InfoResourceController@showResourceFilter')->name('resource_filter');
get('resources', 'InfoResourceController@index');


/**
 * These frontend controllers require the user to be logged in
 */
$router->group(['middleware' => 'auth'], function ()
{
	get('dashboard', 'DashboardController@index')->name('dashboard');
	get('profile/edit', 'ProfileController@edit')->name('edit_profile');
	patch('profile/update', 'ProfileController@update');
	get('userhome', 'UserController@showUserHome')->name('userhome');
	get('self_profile', 'UserDashboardController@showSelfProfile')->name('self_profile');
});
