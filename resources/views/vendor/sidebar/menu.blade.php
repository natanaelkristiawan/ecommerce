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
<form style="display: none;" id="upload-picture-attach">@csrf</form>
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
          <label class="form-control-label">Attach File</label>
          <div>
            <button class="btn btn-danger btn-sm btn-upload-attach">Upload</button>
            <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="attach-file-upload" name="attachment" style="display:none">
          </div>

          <table class="table table-flush" id="table_attachment">
           
          </table>

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

  var attachmentCounter = 0;


  var listdata;

  function readURLAttach(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      


      reader.readAsDataURL(input.files[0]);

      var formData = new FormData($('#upload-picture-attach')[0]);
      var real = $('.attach-file-upload').prop('files')[0];
      formData.append('attachment', real);

      $.ajax({
        url: "{{ route('public.upload', array('config'=> 'module.site')).'/'.date('Y').'/'.date('m').'/'.date('d').'/file/attachment' }}",   
        data : formData,
        dataType : 'json',
        type : 'post',
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,
        success : function(result){
         if (typeof result.path !== 'undefined') {
          var html =  '<tr id="attach_'+attachmentCounter+'">'+
              '<td class="image-attach" data-path="'+result.path+'">'+result.file+'</td>'+
              '<td><button onclick="$(\'#attach_'+attachmentCounter+'\').remove()" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button></td>'+
            '</tr>';
          $('#table_attachment').append(html);
          attachmentCounter++;
         }
        }
      });
    }
  }

  $(".attach-file-upload").change(function() {
    readURLAttach(this);
  });

  $(document).ready(function() {
    $('.btn-upload-attach').on('click', function(){
      $('.attach-file-upload').click();
    });
  });





  $(document).on('click', '#save-report-bug', function() {
    if (ajax_running) {
      return
    }

    var report = $('.textarea-report').val();

    if (report == '') {

      toastr.error('Report Not Send');
      return;

    }

    var image_path = [];


    $.each($('.image-attach'), function(){
      var path = $(this).data('path');
      image_path.push(path)
    });

    $.ajax({
      url : "{{ route('public.report') }}",
      type : "POST",
      dataType : 'json',
      data : $.extend(false, TOKEN, {report : report, images: image_path}),
      beforeSend : function(){
        ajax_start();
        $('#modal-report-bug').modal('hide');
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
        $('#table_attachment').html('');
      }
    });
  })
</script>
@stop
@endif