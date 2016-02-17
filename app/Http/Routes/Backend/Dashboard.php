<?php

get('dashboard', 'DashboardController@index')->name('backend.dashboard');
get('keywords', 'DashboardController@keywords')->name('backend.keywords');
get('sources', 'DashboardController@sources')->name('backend.sources');
get('articles', 'DashboardController@articles')->name('backend.articles');
get('reports', 'DashboardController@reports')->name('backend.reports');
get('signup', 'DashboardController@signup')->name('backend.signup');
get('betaInvite', 'DashboardController@betaInvite')->name('backend.betainvites');
get('reengageEmail', 'DashboardController@reengageEmail')->name('backend.reengageEmail');
get('scripts', 'DashboardController@scripts')->name('backend.scripts');
get('runScript', 'DashboardController@runScript')->name('backend.runScript');
