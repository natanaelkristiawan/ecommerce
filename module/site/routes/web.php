<?php
$route->group(['middleware' => ['web']], function ($route) {
	$route->get('', 'SiteResourceController@index')->name('public');
});