<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'orders-pending'], function($route) {
			$route->get('', 'OrderPendingController@index')->name('admin.orderPending');
		});	
		$route->group(['prefix' => 'orders-success'], function($route) {
      $route->get('', 'OrderSuccessController@index')->name('admin.orderSuccess');
		});
	});
});