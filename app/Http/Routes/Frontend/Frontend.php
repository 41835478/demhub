<?php

/**
 * Frontend Controllers.
 */

get('/',        'FrontendController@index')->name('home');
get('about',    'FrontendController@about');
get('policy',   'FrontendController@policy');
get('terms',    'FrontendController@terms');

get('getLandingData',   'FrontendController@getLandingData')->name('getLandingData');
get('signUpSuccess',    'FrontendController@signUpSuccess')->name('signUpSuccess');

get( 'feedback',    'FrontendController@getFeedback');
post('feedback',    'FrontendController@postFeedback')->name('post_feedback');

get('unsubscribe', 'FrontendController@unsubscribe')->name('unsubscribe');



/*
 * Division Routes
 * Namespaces indicate folder structure
 * TODO - Implement folder structure
 */
get( 'divisions',           'DivisionController@index');
get( 'division/{slug}',     'DivisionController@show')->where('slug', '[A-Za-z0-9_\-]+');
get( 'divisions/results',   'DivisionController@index');
post('divisions/results',   'DivisionController@results');

/*
 * Info Resources Routes
 * Namespaces indicate folder structure
 * TODO - Implement folder structure
*/
get('resources', 'InfoResourceController@index')->name('info_resources');

/*
 * Public Publication Route
 */
get('public_journal', 'PublicationController@public_publication')->name('publications');

/*
 * These frontend controllers require the user to be logged in
 */
$router->group(['middleware' => 'auth'], function () {
    post('invite', 'FrontendController@inviteSignup')->name('invite_others');

    get('discussion', 'ForumController@showDiscussionIndex' )->name('discussion');

    get('userhome',             'UserController@index'          )->name('userhome');
    get('get_activities',       'UserController@getActivities'  )->name('get_activities');
    get('get_articles/{scope}', 'UserController@getArticles'    )->name('get_articles');

    // NOTE - DashboardController@index used instead of @edit_profile
    get('dashboard',    'DashboardController@index'             )->name('dashboard');
    get('connections',  'DashboardController@showConnections'   )->name('connections');
    get('bookmarks',  'DashboardController@showBookmarks'   )->name('bookmarks');
    get('content-thread/{id}',  'FrontendController@contentThreadConnect'   )->where('id', '[A-Za-z0-9_\-]+');
    /*
     * Search
     */
    get('search', 'SearchController@index')->name('search');

    /*
     * Publication Routes
     */
    get(  'my_publications',            'PublicationController@index'   )->name('my_publications');
    post( 'my_publications/{caret}',    'PublicationController@caret_publication_action')->name('caret_publication_action');

    get(  'my_publication/new',         'PublicationController@create'  )->name('new_publication');
    post( 'my_publication/store',       'PublicationController@store'   )->name('store_publication');
    get(  'my_publication/{id}/edit',   'PublicationController@edit'    )->name('edit_publication');
    patch('my_publication/{id}',        'PublicationController@update'  )->name('update_publication');

    get(  'publication/{id}/view',      'PublicationController@view'    )->name('view_publication');
    get(  'publication/{id}',           'PublicationController@preview' )->name('preview_publication');

    // Bookmark
    get('bookmark_content/{id}/{type}',    'ContentController@bookmarkContent'     )->name('bookmark_content');
    post('bookmark_content/{id}/{type}',    'ContentController@bookmarkContent'     )->name('bookmark_content');
    post('unbookmark_content/{id}/{type}',  'ContentController@unbookmarkContent'   )->name('unbookmark_content');

    /*
     * Public Profiles
     */
    patch('profile/update',         'ProfileController@update')->name('update_profile');
    get(  'profile/{user_name}',    'ProfileController@view_public_profile')->name('view_public_profile');
    get(  'profiles',               'ProfileController@listing_of_profiles')->name('profiles');

    // Follow/unfollow
    post('follow/{id}',             'ProfileController@followUser')->name('follow_user');
    post('unfollow/{id}',           'ProfileController@unfollowUser')->name('unfollow_user');

    // Temp routes for testing user activity feed
    get('userActivityFeed', 'UserController@userActivityFeed')->name('userActivityFeed');
});

/*
 * Scheduler routes
 */
get('scheduler/scrapeRSS',      'SchedulerController@scrapeRSS');
get('scheduler/scrapeCustom',   'SchedulerController@scrapeCustom');
get('scheduler/initialize',     'SchedulerController@initialize');
get('scheduler/toolbox',        'SchedulerController@toolbox');
//deprecated
get('scheduler/scrapeIRDR',     'SchedulerController@scrapeIRDR');
get('scheduler/scrapeEC',       'SchedulerController@scrapeEC');

/*
 * Articles routes
 */
get('article/browse', 'ArticleController@browse');
get('article/stream', 'ArticleController@stream');
get('article/report', 'ArticleController@report');
