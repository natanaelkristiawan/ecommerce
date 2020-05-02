<?php
$route->group(['middleware' => ['web']], function ($route) {

  $route->get('ipconfig', function(){
    $_IP_ADDRESS = $_SERVER['REMOTE_ADDR'];
    $_PERINTAH = "arp -a $_IP_ADDRESS";
    ob_start();
    system($_PERINTAH);
    $_HASIL = ob_get_contents();
    ob_clean();
    $_PECAH = strstr($_HASIL, $_IP_ADDRESS);
    $_PECAH_STRING = explode($_IP_ADDRESS, str_replace(" ", "", $_PECAH));

    var_dump($_PECAH_STRING);

    die();

    $_HASIL = substr($_PECAH_STRING, 0, 17);
    echo "IP Anda : ".$_IP_ADDRESS."MAC ADDRESS Anda : ".$_HASIL;

  });


	$route->get('', 'SiteResourceController@index')->name('public');
  $route->get('login', 'SiteResourceController@login')->name('login');
  $route->post('login', 'SiteResourceController@doLogin');
  $route->get('register', 'SiteResourceController@register')->name('register');
  $route->get('logout', 'SiteResourceController@logout')->name('logout');
  $route->post('register', 'SiteResourceController@doRegister');
  $route->get('r3m0v3-p3nd1n9', 'SiteResourceController@removePending');

  $route->get('management', function(){
    session()->flash('status', 'Comming Soon!');
    return redirect()->route('dashboard');
  })->name('public.management');

  // dashboard

  $route->get('dashboard', 'DashboardResourceController@index')->name('dashboard');

  $route->get('order-pending', 'DashboardResourceController@orderPending')->name('public.orderPending');
  $route->get('order-success', 'DashboardResourceController@orderSuccess')->name('public.orderSuccess');
  $route->get('myproduct', 'DashboardResourceController@myproduct')->name('public.myproduct');

  $route->post('order-create', 'DashboardResourceController@orderCreate')->name('public.orderCreate');
  $route->post('order-waiting', 'DashboardResourceController@orderWaitingConfirmation')->name('public.orderWaitingConfirmation');


  $route->get('order-delete/{id}', 'DashboardResourceController@deleteOrder')->name('public.orderDelete');
  $route->get('invoice/{id}', 'DashboardResourceController@invoice')->name('public.invoice');

  $route->get('profile', 'DashboardResourceController@profile')->name('public.profile');
  $route->post('profile', 'DashboardResourceController@doUpdateProfile');
  $route->post('update-profile-picture', 'DashboardResourceController@updateProfilePicture')->name('public.update-profile-picture');
  $route->get('demo', 'DashboardResourceController@demo')->name('public.demo');
  $route->get('management-sender', 'DashboardResourceController@managementSender')->name('public.managementSender');

  $route->post('generate-token', 'DashboardResourceController@generateToken')->name('public.generateToken');
  $route->post('save-device-id', 'DashboardResourceController@saveDeviceID')->name('public.saveDeviceID');


  $route->post('report', 'DashboardResourceController@report')->name('public.report');
});