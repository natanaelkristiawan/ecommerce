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


    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <div class="row">
            
          <div class="col-lg-6">
            <h3 class="mb-0">White List Device</h3>
          </div>     
          <div class="col-lg-6 text-right">
            <button type="button" class="btn btn-sm btn-danger" id="addDeviceBtn" type="button">Add Device</button>
            <button type="button" class="btn btn-sm btn-primary" id="saveDevice" type="button">Save</button>
          </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-flush">
            <thead class="thead-light">
              <tr>
                <th>Device ID</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Device ID</th>
                <th width="10%">Action</th>
              </tr>
            </tfoot>
            <tbody id="data-device-id">
            </tbody>
          </table>
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


<script type="x-tmpl-mustache" id="template">
<tr id="device@{{count}}">
  <td><input type="text"  class="form-control deviceList" value="@{{value}}" name="device_id[@{{count}}]"></td>
  <td><button onclick="$('#device@{{count}}').remove()" class="btn btn-sm btn-danger">Delete</button></td>
</tr>
</script>



<script type="text/javascript">
  var count = 0;
  $(document).ready(function() {

    var deviceList = {!! json_encode($data->device_id) !!}

    $.each(deviceList, function(key, value){
      var template = $('#template').html();
      htmlBody = Mustache.render(template, {count : count, value:value});
      $('#data-device-id').append(htmlBody);
      count++;
    })

    $('#addDeviceBtn').on('click', function(){

      var total = 0



      $.each($('.deviceList'), function(){
        total++;
      }) 

      if (total > 2) {
        return false;
      }


      var template = $('#template').html();
      htmlBody = Mustache.render(template, {count : count});
      $('#data-device-id').append(htmlBody);
      count++;
    })

    $('#saveDevice').on('click', function(){




      if (ajax_running) {
        return false;
      }

      var device_id = [];


      $.each($('.deviceList'), function(){
        device_id.push($(this).val());
      }) 
       $.ajax({
          url : "{{ route('public.saveDeviceID') }}",
          type : 'post',
          dataType: 'json',
          data: $.extend(false, TOKEN, {device_id:device_id}),
          beforeSend: function(){
            ajax_start();
          },
          success: function(result){

          },
          complete: function(){
            ajax_stop();
            Swal.fire(
              'Success!',
              'Your Device Id has been save',
              'success'
            )
          }
        });

    });

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