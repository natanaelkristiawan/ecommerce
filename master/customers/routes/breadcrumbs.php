<?php

Breadcrumbs::for('customers', function ($trail) {
  $trail->push('Customers', route('admin.customers'));
});

Breadcrumbs::for('customer.profile', function ($trail) {
  $trail->parent('customers');
  $trail->push('Profile', '');
});