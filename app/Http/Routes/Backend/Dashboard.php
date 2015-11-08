<?php

get('dashboard', 'DashboardController@index')->name('backend.dashboard');
get('keywords', 'DashboardController@keywords')->name('backend.keywords');
get('sources', 'DashboardController@sources')->name('backend.sources');
get('articles', 'DashboardController@articles')->name('backend.articles');