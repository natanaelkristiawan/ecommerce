<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'orders'], function($route) {
			$route->get('/', 'OrdersResourceController@index')->name('admin.orders');
			$route->get('/create', 'OrdersResourceController@create')->name('admin.orders.create');
			$route->post('/create', 'OrdersResourceController@store');
			$route->get('/edit/{id}', 'OrdersResourceController@edit')->name('admin.orders.edit');
			$route->post('/edit/{id}', 'OrdersResourceController@update');
			$route->get('delete/{id}', 'OrdersResourceController@delete')->name('admin.orders.delete');
		});
	});
});