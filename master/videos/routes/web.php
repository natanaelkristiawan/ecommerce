<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'videos'], function($route) {
			$route->get('/', 'VideosResourceController@index')->name('admin.videos');
			$route->get('/create', 'VideosResourceController@create')->name('admin.videos.create');
			$route->post('/create', 'VideosResourceController@store');
			$route->get('/edit/{id}', 'VideosResourceController@edit')->name('admin.videos.edit');
			$route->post('/edit/{id}', 'VideosResourceController@update');
			$route->get('delete/{id}', 'VideosResourceController@delete')->name('admin.videos.delete');
		});
	});
});