 <?php

Breadcrumbs::for('invitecodes', function ($trail) {
  $trail->push('Invite Codes', route('admin.invitecodes'));
});