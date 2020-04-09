<ul class="navbar-nav">
  @foreach($groups as $group)
      {!! $group !!}
  @endforeach
</ul>


<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading p-0 text-muted">Account</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
  <li class="nav-item">
    <a class="nav-link" href="">
      <i class="ni ni-spaceship"></i>
      <span class="nav-link-text">Profile</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link">
      <i class="ni ni-button-power"></i>
      <span class="nav-link-text">Logout</span>
    </a>
  </li>
</ul>