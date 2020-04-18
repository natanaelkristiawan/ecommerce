@extends('theme.admin.layouts.blank')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">{!! Meta::get('title') !!}</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
          {{ Breadcrumbs::render('customers') }}
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <button type="button" data-toggle="modal" data-target="#modal-filter" class="btn btn-sm btn-neutral">Filter</button>
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
          <h3 class="mb-0">Data</h3>
        </div>
        <div class="table-responsive py-4">
          @include('customers::admin.customers.partials.table')
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

@include('customers::admin.customers.partials.filter')
@stop


@section('script')
@parent

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
      { orderable: false, targets: 5 },
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
      url: "{{ route('admin.customers') }}",
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
      {data : 'name'},
      {data : 'email'},
      {data : 'invite_code'},
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