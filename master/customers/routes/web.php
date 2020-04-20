<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'customers'], function($route) {
			$route->get('/', 'CustomersResourceController@index')->name('admin.customers');
      $route->get('create', 'CustomersResourceController@create')->name('admin.customers.create');
      $route->post('create', 'CustomersResourceController@store');
      $route->get('profile/{id}', 'CustomersResourceController@profile')->name('admin.customers.profile');
      $route->post('profile/{id}', 'CustomersResourceController@update');
      $route->get('delete/{id}', 'CustomersResourceController@delete')->name('admin.customers.delete');
		});
	});
});