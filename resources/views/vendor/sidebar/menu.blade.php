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
    @if ($guard_now == 'admin')
    <a class="nav-link" href="">
    @else
    <a class="nav-link" href="{{ route('public.profile') }}">
    @endif
      <i class="ni ni-spaceship"></i>
      <span class="nav-link-text">Profile</span>
    </a>
  </li>
  @if ($guard_now == 'web')
  <li class="nav-item">
    <a class="nav-link" href="{{ route('public') }}">
      <i class="ni ni-app"></i>
      <span class="nav-link-text">Go To Site</span>
    </a>
  </li>
  @endif
  <li class="nav-item">
    @if ($guard_now == 'admin')
    <a href="{{ route('admin.logout') }}" class="nav-link">
    @else
    <a href="{{ route('logout') }}" class="nav-link">
    @endif
      <i class="ni ni-button-power"></i>
      <span class="nav-link-text">Logout</span>
    </a>
  </li>
</ul>