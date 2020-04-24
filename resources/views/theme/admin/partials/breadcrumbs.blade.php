@if (count($breadcrumbs))

  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
      @if ($guard_now == 'admin')
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
      @else
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
      @endif
      @foreach ($breadcrumbs as $breadcrumb)
          @if ($breadcrumb->url && !$loop->last)
              <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
          @else
              <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->title }}</li>
          @endif

      @endforeach
  </ol>

@endif