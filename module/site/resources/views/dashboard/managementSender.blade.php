@extends('theme.public.layouts.blank')

@section('content')
<form style="display: none;" id="upload-picture">@csrf</form>
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">{!! Meta::get('title') !!}</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
          {{ Breadcrumbs::render('managementSender') }}
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid mt--6">
  <!-- Table -->
  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          <div class="row">
            
          <div class="col-lg-6">
            <h3 class="mb-0">Token Api</h3>
          </div>     
          <div class="col-lg-6 text-right">
            <button class="btn btn-sm btn-danger" id="generateToken" type="button">Generate Token</button>
          </div>
          </div>
        </div>
        <div class="card-body">
         <div class="form-group">
            <label class="form-control-label">Public Key</label> 
            <input readonly="" id="publicKey" value="{{ $data->public_key }}" type="text" placeholder="Public Key" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-control-label">Private Key</label> 
            <input readonly type="text" id="privateKey" value="{{ $data->private_key }}" placeholder="Private Key" value=""class="form-control">
          </div> 
        </div>
      </div>
    </div>
  <!-- Footer -->
  </div>
  @include('theme.admin.partials.copyright')
</div>
@stop

@section('script')
@parent
<script type="text/javascript">
  $(document).ready(function() {
    $('#generateToken').on('click', function(){
      if (ajax_running) {
        return false;
      }

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Generate it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url : "{{ route('public.generateToken') }}",
            type : 'post',
            dataType: 'json',
            data: $.extend(false, TOKEN),
            beforeSend: function(){
              ajax_start();
            },
            success: function(result){
              $('#publicKey').val(result.publicKey);
              $('#privateKey').val(result.privateKey);
            },
            complete: function(){
              ajax_stop();
              Swal.fire(
                'Success!',
                'Your token has been generate.',
                'success'
              )
            }
          });
        }
      })
    });
  });

</script>
@stop