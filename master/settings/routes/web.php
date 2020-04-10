<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'settings'], function($route) {
			$route->get('/', 'SettingsResourceController@index')->name('admin.settings');
			$route->get('/create', 'SettingsResourceController@create')->name('admin.settings.create');
			$route->post('/create', 'SettingsResourceController@store');
			$route->get('/edit/{id}', 'SettingsResourceController@edit')->name('admin.settings.edit');
			$route->post('/edit/{id}', 'SettingsResourceController@update');
			$route->get('delete/{id}', 'SettingsResourceController@delete')->name('admin.settings.delete');
		});
	});
});