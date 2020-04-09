<!DOCTYPE html>
<html>

<head>
@include('theme.admin.partials.metadata')
</head>

<body>
   @include('theme.admin.partials.sidebar')
  <!-- Main content -->
  <div class="main-content" id="panel">
    @yield('content')
  </div>

  @include('theme.admin.partials.modal')
  @include('theme.admin.partials.footer')
</body>