<?php
$route->group(['middleware' => ['web']], function ($route) {
	$route->get('', 'SiteResourceController@index')->name('public');
  $route->get('login', 'SiteResourceController@login')->name('login');
  $route->post('login', 'SiteResourceController@doLogin');
  $route->get('register', 'SiteResourceController@register')->name('register');
  $route->post('register', 'SiteResourceController@doRegister');
});