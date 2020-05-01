<?php

Breadcrumbs::for('siteOrderPending', function ($trail) {
  $trail->push('Order Pending', route('public.orderPending'));
});


Breadcrumbs::for('siteOrderSuccess', function ($trail) {
  $trail->push('Order Success', route('public.orderSuccess'));
});


Breadcrumbs::for('profile', function ($trail) {
  $trail->push('Profile', route('public.profile'));
});

Breadcrumbs::for('demo', function ($trail) {
  $trail->push('Demo', route('public.demo'));
});


Breadcrumbs::for('myproduct', function ($trail) {
  $trail->push('My Product', route('public.myproduct'));
});

Breadcrumbs::for('managementSender', function ($trail) {
  $trail->push('Management Sender', route('public.managementSender'));
});

