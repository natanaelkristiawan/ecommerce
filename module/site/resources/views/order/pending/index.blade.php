@extends('theme.public.layouts.blank')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">{!! Meta::get('title') !!}</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
          {{ Breadcrumbs::render('siteOrderPending') }}
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt--6">
  <!-- Table -->
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <h3 class="mb-0">Data Order Pending</h3>
        </div>
        <div class="table-responsive py-4">
            @include('site::order.pending.partials.table')
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  @include('theme.admin.partials.copyright')
</div>
@stop

@section('modal')
@parent

<div data-backdrop="static" data-keyboard="false" class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div style="min-height: calc(50vh)" class="modal-dialog modal-sm modal-" role="document">
    <div class="modal-content">
      <div class="modal-header pb-0">
        <h6 class="modal-title" id="modal-title-default">Upload File</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="upload-file">
      </div>
    </div>
  </div>
</div>


@stop


@section('script')
@parent
<link href="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css" type="text/css" rel="stylesheet" />
<script src="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

<script type="x-tmpl-mustache" id="template-upload">
  <div class="dropzone dropzone-single mb-3 dz-clickable">
    <div class="fallback">
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="projectCoverUploads">
        <label class="custom-file-label" for="projectCoverUploads">Choose file</label>
      </div>
    </div>
    <div class="dz-preview dz-preview-single">
      <div class="dz-preview-cover">
        <img class="dz-preview-img" src="" alt="" data-dz-thumbnail>
      </div>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-12 mb-3" style="text-align: center;">
      <button data-path="" id="btn-save" data-order_id="@{{ order_id }}" class="btn btn-danger w-100" >Save</button>
    </div>
    <div class="col-12" style="max-height: 150px; overflow-y: auto;">
      <h3>Transfer Account</h3>
      @foreach($accounts as $account)
        <div>{{ $account['bank'] }} - {{ $account['account'] }} ({{ $account['name'] }})</div>
      @endforeach
    </div>
  </div>
</script>

<script src="{{ asset('template/argon') }}/assets/vendor/dropzone/dist/min/dropzone.min.js"></script>

<style type="text/css">
  .dz-preview-single {
    position: absolute !important;
    top: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    left: 50% !important;
    transform: translateX(-60%);
    border-radius: .375rem;
  }
</style>
<script type="text/javascript">
Dropzone.autoDiscover = false;
var oTable;
var page = 1;

$(document).on('click', '#btn-save', function(){
  $.ajax({
    url : "{{ route('public.orderWaitingConfirmation') }}",
    data : $.extend(false, TOKEN, {transfer_confirmation: $('#btn-save').data('path'), order_id: $('#btn-save').data('order_id')}),
    type: 'post',
    dataType : 'json',
    beforeSend: function(){
      $('#modal-default').modal('hide');
    },
    success : function(result){
      if (result.status == true) {
        toastr.success('Waiting For Admin Confirm', 'Success');
        oTable.api().draw('page');
      } else {
        toastr.error('Failed To Save Data', 'Error');
      }
    }

  });
})

$(document).on('click', '.btn-upload', function(){
  var template = $('#template-upload').html();

  var order_id = $(this).data('id');

  htmlBody = Mustache.render(template, {order_id : order_id});

  $('#upload-file').html(htmlBody);

  $('.dropzone-single').dropzone({
    url: "{{ route('public.upload', array('config' => 'master.orders', 'path' => date('Y/m/d').'/file/file/')) }}",
    thumbnailWidth: null,
    thumbnailHeight: null,
    previewsContainer: $('.dz-preview').get(0),
    previewTemplate: $('.dz-preview').html(),
    maxFiles:  1,
    acceptedFiles:'image/*',
    init: function() {
      this.on("addedfile", function(file) {
        currentFile = file;
      });

      this.on("sending", function(file, xhr, formData) {
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formData.append("order_id", order_id);
      });


      this.on("success", function(file, response) {
        if (response === ""){
          toastr.error('Files maximum size.', 'Error');
        } else {  
          $('#btn-save').attr('data-path', response.path);
        }
      });
    }
  });
  $('#modal-default').modal('show');
});


$(document).ready(function() {
  // Init dropzone
  oTable = $('#datatable').dataTable({
    pageLength: 10,
    responsive: true,
    dom: 'lrtip',
    order: [[ 0, "asc" ]],
    columnDefs: [
      { orderable: false, targets: 8},
    ],
    processing: true,
    serverSide: true,
    language: { 
      paginate: {
        previous: "<i class='fas fa-angle-left'>",
        next: "<i class='fas fa-angle-right'>"
      }
    },
    ajax: {
      url: "{{ route('public.orderPending') }}",
      dataType: "json",
      type: "GET",
      data: function ( d ) {
        oSearch = {};
        $('.filter-field').each( function () {
          key = $(this).attr('name');
          val = $(this).val();
          oSearch[key] = val;
        });
        return $.extend(false, TOKEN, {page : page}, oSearch, d);
      }
    },
    preDrawCallback: function( settings ) {
      var api = this.api();
      page = parseInt(api.rows().page()) + 1;
    },
    columns: [
      {data : 'created_at'},
      {data : 'email'},
      {data : 'product'},
      {data : 'unique_code'},
      {data : 'transfer_confirmation'},
      {data : 'total'},
      {data : 'timeout'},
      {data : 'status'},
      {data : 'action'},
    ],
  });

  $('.filter-btn').on('click', function(){
    oTable.api().draw();
  }); 

  $('.filter-clean').on('click', function(){
    $('.filter-field').val('');
    oTable.api().draw();
  });
});
</script>
@stop