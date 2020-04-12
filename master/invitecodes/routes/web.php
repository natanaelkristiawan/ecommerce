<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'invitecodes'], function($route) {
			$route->get('/', 'InvitecodesResourceController@index')->name('admin.invitecodes');
			$route->get('/create', 'InvitecodesResourceController@create')->name('admin.invitecodes.create');
			$route->post('/create', 'InvitecodesResourceController@store');
			$route->get('/edit/{id}', 'InvitecodesResourceController@edit')->name('admin.invitecodes.edit');
			$route->post('/edit/{id}', 'InvitecodesResourceController@update');
			$route->get('delete/{id}', 'InvitecodesResourceController@delete')->name('admin.invitecodes.delete');
		});
	});
});