<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'invitecodes'], function($route) {
			$route->get('/', 'InvitecodesResourceController@index')->name('admin.invitecodes');
			$route->get('delete/{id}', 'InvitecodesResourceController@delete')->name('admin.invitecodes.delete');
			$route->post('generate-code', 'InvitecodesResourceController@generateCode')->name('admin.invitecodes.generatecode');
		});
	});
});