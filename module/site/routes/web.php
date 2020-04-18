<?php
$route->group(['middleware' => ['web']], function ($route) {
	$route->get('', 'SiteResourceController@index')->name('public');
  $route->get('login', 'SiteResourceController@login')->name('login');
  $route->post('login', 'SiteResourceController@doLogin');
  $route->get('register', 'SiteResourceController@register')->name('register');
  $route->get('logout', 'SiteResourceController@logout')->name('logout');
  $route->post('register', 'SiteResourceController@doRegister');


  // dashboard

  $route->get('dashboard', 'DashboardResourceController@index')->name('dashboard');

  $route->get('order-pending', 'DashboardResourceController@orderPending')->name('public.orderPending');
  $route->get('order-success', 'DashboardResourceController@orderSuccess')->name('public.orderSuccess');

  $route->post('order-create', 'DashboardResourceController@orderCreate')->name('public.orderCreate');
  $route->post('order-waiting', 'DashboardResourceController@orderWaitingConfirmation')->name('public.orderWaitingConfirmation');


  $route->get('order-delete/{id}', 'DashboardResourceController@deleteOrder')->name('public.orderDelete');
  $route->get('invoice/{id}', 'DashboardResourceController@invoice')->name('public.invoice');
});