<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'customers'], function($route) {
			$route->get('/', 'CustomersResourceController@index')->name('admin.customers');
		});
	});
});