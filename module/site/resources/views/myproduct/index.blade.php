@extends('theme.public.layouts.blank')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">{!! Meta::get('title') !!}</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
          {{ Breadcrumbs::render('myproduct') }}
          </nav>
        </div>
       <div class="col-lg-6 text-lg-right">
	<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-filter">  How to use  </button>
          <h3 style="color: white">Your Product Password : {{ Auth::guard('web')->user()->invite_code }}</h3>
        </div>
      </div>
    </div>
  </div>
</div>
<div>
<div class="container-fluid mt--6">
  <!-- Table -->
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <h3 class="mb-0">Download Product</h3>
        </div>
        <div class="table-responsive py-4">
            @include('site::myproduct.partials.table')
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  @include('theme.admin.partials.copyright')
</div>
</div>
@stop


@section('script')
@parent

<div class="modal fade" id="modal-filter" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modal-filter" aria-hidden="true">
  <div id="dialog-privacy" class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header pb-0">
        <h3>How to use RG43S Product</h3>
      </div>
      <div class="modal-body pt-0" id="modal-data">
          <strong>English &#x2B07;<br></strong>
        <br>➤ Download your product first.
        <br>➤ Extract with WinRAR.
        <br>➤ Use the password bellow
         <strong><br><br>Indonesia &#x2B07;<br></strong>
        <br>➤ Download productmu terlebih dahulu.
        <br>➤ Extract file product mu menggunakan WinRAR.
        <br>➤ Gunakan password dibawah ini untuk lanjut mengExtract.
        <br><br><strong>Password : {{ Auth::guard('web')->user()->invite_code }}</strong></br>
        <br><br><strong>Contact Admin : <a href="https://t.me/rg43smarket" target="blank_">Mathias</strong></br></a>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<link href="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css" type="text/css" rel="stylesheet" />
<script src="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
var oTable;
var page = 1;
$(document).ready(function() {
  oTable = $('#datatable').dataTable({
    pageLength: 10,
    responsive: true,
    dom: 'lrtip',
    order: [[ 0, "desc" ]],
    columnDefs: [
      { orderable: false, targets: 4},
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
      url: "{{ route('public.myproduct') }}",
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
      {data : 'buy_at'},
      {data : 'product'},
      {data : 'total'},
      {data : 'download_link'},
      {data : 'status'}
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
