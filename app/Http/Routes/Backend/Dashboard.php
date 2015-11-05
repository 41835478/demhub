<?php

get('dashboard', 'DashboardController@index')->name('backend.dashboard');
get('keywords', 'DashboardController@keywords')->name('backend.keywords');