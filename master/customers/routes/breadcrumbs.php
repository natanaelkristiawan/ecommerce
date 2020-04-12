<?php

Breadcrumbs::for('customers', function ($trail) {
  $trail->push('Customers', route('admin.customers'));
});