<?php

Breadcrumbs::for('videos', function ($trail) {
  $trail->push('Articles', route('admin.videos'));
});

Breadcrumbs::for('videos.create', function ($trail) {
  $trail->parent('videos');
  $trail->push('Create', route('admin.videos.create'));
});

Breadcrumbs::for('videos.edit', function ($trail) {
  $trail->parent('videos');
  $trail->push('Edit', route('admin.videos.create'));
});