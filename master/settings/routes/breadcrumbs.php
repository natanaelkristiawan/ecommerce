<?php

Breadcrumbs::for('settings', function ($trail) {
  $trail->push('Settings', route('admin.settings'));
});
