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
    <a class="nav-link" href="{{ route('admin.profile') }}">
    @else
    <a class="nav-link" href="{{ route('public.profile') }}">
    @endif
      <i class="ni ni-single-02"></i>
      <span class="nav-link-text">Profile</span>
    </a>
  </li>
  @if ($guard_now == 'web')
  <li class="nav-item">
    <a class="nav-link" href="{{ route('public') }}">
      <i class="ni ni-spaceship"></i>
      <span class="nav-link-text">Go To Site</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="javascript:;" data-toggle="modal" data-target="#modal-report-bug">
      <i class="ni ni-send"></i>
      <span class="nav-link-text">Report Bug</span>
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




@if ($guard_now == 'web')
@section('script')
<div class="modal fade" id="modal-report-bug" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modal-filter" aria-hidden="true">
  <div id="dialog-privacy" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header pb-0">
        <h3>Report Bug</h3>
      </div>
      <div class="modal-body pt-0">
         <div class="form-group">
          <textarea class="form-control textarea-report" rows="8" name="bug_report"></textarea>
        </div>
        <div class="form-group">
          <button class="btn btn-primary btn-sm" type="button" id="save-report-bug">Save</button>
          <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  var ajax_running = false;
  function ajax_start() {
    ajax_running = true;
  }

  function ajax_stop() {
    ajax_running = false;
  }


  $(document).on('click', '#save-report-bug', function() {
    if (ajax_running) {
      return
    }

    var report = $('.textarea-report').val();

    if (report == '') {

      toastr.error('Report Not Send');
      return;

    }

    $.ajax({
      url : "{{ route('public.report') }}",
      type : "POST",
      dataType : 'json',
      data : $.extend(false, TOKEN, {report : report}),
      beforeSend : function(){
        ajax_start();
        $('#modal-report-bug').modal('hide')
      },
      success : function(result) {
        if (result.status) {
          toastr.success('Report Send');
        } else {
          toastr.error('Report Not Send');

        }
      },
      complete: function() {
        ajax_stop();
        $('.textarea-report').val('');
      }
    });
  })
</script>
@stop
@endif