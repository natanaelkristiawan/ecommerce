<?php

Breadcrumbs::for('orderPending', function ($trail) {
  $trail->push('Order Pending', route('admin.orderPending'));
});

Breadcrumbs::for('orderSuccess', function ($trail) {
  $trail->push('Order Pending', route('admin.orderSuccess'));
});