@extends('theme.public.layouts.blank')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">{!! Meta::get('title') !!}</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
          {{ Breadcrumbs::render('siteOrderSuccess') }}
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <h1 style="color: white">Password : {{ Auth::guard('web')->user()->invite_code }}</h1>
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
          <h3 class="mb-0">Data Order Success</h3>
        </div>
        <div class="table-responsive py-4">
            @include('site::order.success.partials.table')
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  @include('theme.admin.partials.copyright')
</div>
@stop


@section('script')
@parent
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
      url: "{{ route('public.orderSuccess') }}",
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
      {data : 'invoice'},
      {data : 'email'},
      {data : 'product'},
      {data : 'unique_code'},
      {data : 'transfer_confirmation'},
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