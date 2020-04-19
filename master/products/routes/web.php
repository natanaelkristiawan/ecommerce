<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'products'], function($route) {
			$route->get('/', 'ProductsResourceController@index')->name('admin.products');
			$route->get('/create', 'ProductsResourceController@create')->name('admin.products.create');
			$route->post('/create', 'ProductsResourceController@store');
			$route->get('/edit/{id}', 'ProductsResourceController@edit')->name('admin.products.edit');
			$route->post('/edit/{id}', 'ProductsResourceController@update');
			$route->get('delete/{id}', 'ProductsResourceController@delete')->name('admin.products.delete');
		});


		$route->group(['prefix'=> 'zip'], function($route) {
			$route->get('create/{id}', 'ZipResourcesController@create')->name('admin.zip.create');
		});
	});
});