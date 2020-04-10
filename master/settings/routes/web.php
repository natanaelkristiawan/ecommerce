<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'settings'], function($route) {
			$route->get('/', 'SettingsResourceController@index')->name('admin.settings');
			$route->post('/', 'SettingsResourceController@store');
		});
	});
});