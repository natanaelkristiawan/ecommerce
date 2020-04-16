<?php

Breadcrumbs::for('siteOrderPending', function ($trail) {
  $trail->push('Order Pending', route('public.orderPending'));
});