@extends('theme.admin.layouts.blank')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">{!! Meta::get('title') !!}</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
          {{ Breadcrumbs::render('customer.profile') }}
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
            <a href="{{ route('admin.customers') }}" class="btn btn-sm btn-danger">Close</a>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid mt--6">
  <!-- Table -->
  <div class="row">
    <div class="col-lg-3">
      <div class="card card-profile">
        <img src="{{ asset('template/argon') }}/assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
        <div class="row justify-content-center">
          <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
              <a href="#">
                <img src="{{ asset('template/argon') }}/assets/img/theme/team-4.jpg" class="rounded-circle">
              </a>
            </div>
          </div>
        </div>

        <div class="card-body mt-6 mb-5 pb-0">
          <div class="text-center">
            <h5 class="h3">
              {{ $data->name }}
            </h5>
            <div class="h5 font-weight-300">
              <i class="ni location_pin mr-2"></i>{{ $data->email }}
            </div>
            <div class="h5 mt-4">
              <i class="ni business_briefcase-24 mr-2"></i>Registered At
            </div>
            <div>
              <i class="ni education_hat mr-2"></i>{{ date('d F Y', strtotime($data->created_at)) }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-9">
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <h3 class="mb-0">History</h3>
        </div>
        <div class="table-responsive py-4">
          <table class="table table-flush" id="datatable">
            <thead class="thead-light">
              <tr>
                <th>Created At</th>
                <th>Product</th>
                <th>Total</th>
                <th>Download Link</th>
                <th>Transfer Confirmation</th>
                <th>Status</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Created At</th>
                <th>Product</th>
                <th>Total</th>
                <th>Download Link</th>
                <th>Transfer Confirmation</th>
                <th>Status</th>
              </tr>
            </tfoot>
            <tbody>
            </tbody>
          </table>
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
        url: "{{ route('admin.customers.profile', array('id' => $data->id)) }}",
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
        {data : 'product'},
        {data : 'total'},
        {data : 'download_link'},
        {data : 'transfer_confirmation'},
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