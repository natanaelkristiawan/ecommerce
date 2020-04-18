<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'orders-pending'], function($route) {
			$route->get('', 'OrderPendingController@index')->name('admin.orderPending');
      $route->get('confirm/{id}', 'OrderPendingController@confirm')->name('admin.orderPending.confirm');
      $route->get('delete/{id}', 'OrderPendingController@delete')->name('admin.orderPending.delete');
		});	
		$route->group(['prefix' => 'orders-success'], function($route) {
      $route->get('', 'OrderSuccessController@index')->name('admin.orderSuccess');
      $route->get('invoice/{id}', 'OrderSuccessController@invoice')->name('admin.orderSuccess.invoice');
		});
	});
});