<?php

Breadcrumbs::for('products', function ($trail) {
  $trail->push('Products', route('admin.products'));
});


Breadcrumbs::for('products.create', function ($trail) {
  $trail->parent('products');
  $trail->push('Create', route('admin.products.create'));
});

Breadcrumbs::for('products.edit', function ($trail) {
  $trail->parent('products');
  $trail->push('Edit', route('admin.products.create'));
});