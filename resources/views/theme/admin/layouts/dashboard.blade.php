<!DOCTYPE html>
<html>

<head>
@include('theme.admin.partials.metadata')
</head>

<body>
  <!-- Sidenav -->
  @include('theme.admin.partials.sidebar')
  <!-- Main content -->
  <div class="main-content" id="panel">
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center ml-md-auto">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center ml-auto ml-md-0">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img class="profile-pic" alt="Image placeholder" src="{{ is_null(Auth::guard('admin')->user()->photo) ?  asset('template/argon/assets/img/theme/team-4.jpg') : url('image/profile/'.Auth::guard('admin')->user()->photo) }}">
                  </span>
                  <div class="media-body ml-2 d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">{{ Auth::guard('admin')->user()->name }}</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="{{ route('admin.profile') }}" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.logout') }}" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Admin Dashboard</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Data Temporary</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
        <div class="card card-stats">
             <div class="col-xl-12 col-md-12">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Service</th>
                    <th scope="col">Total</th>
                    <th scope="col">News {{date('F')}}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">
                      User Registered
                    </th>
                    <td>
                      {{ number_format(Customers::countAll()) }}
                    </td>
                    <td>
                       {{ number_format(Customers::countThisMonth()) }}
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      Order Pending
                    </th>
                    <td>
                      {{ number_format(Orders::countAllPending()) }}
                    </td>
                    <td>
                      {{ number_format(Orders::countAllPendingThisMonth()) }}
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      Order Success
                    </th>
                    <td>
                      {{ number_format(Orders::countAllSuccess()) }}
                    </td>
                    <td>
                     {{ number_format(Orders::countAllSuccessThisMonth()) }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col-lg-6">
                  <h3 class="mb-0">Data Reporting Bug</h3>
                </div>

                <div class="col-lg-6 text-right">
                  <button  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-filter">Filters</button>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush" id="table-report">
                <thead class="thead-light">
                  <tr>
                    <th width="15%">Created At</th>
                    <th width="15%">Email</th>
                    <th>Report</th>
                    <th>Images</th>
                    <th width="15%">Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="modal-filter" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modal-filter" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label>Email</label> 
                    <input type="text" placeholder="Search Email" name="search[email]" class="form-control filter-field">
                  </div>
                </div>
              </div>
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger filter-btn">Filter</button>
              <button type="button" class="btn btn-primary filter-clean">Clear</button>
              <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center text-lg-left text-muted">
              &copy; {{ date('Y') }} <a href="https://t.me/rg43smarket" class="font-weight-bold ml-1" target="_blank">RG43S Admin With &#10084; </a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('template/argon') }}/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="{{ asset('template/argon') }}/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('template/argon') }}/assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="{{ asset('template/argon') }}/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="{{ asset('template/argon') }}/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="{{ asset('template/argon') }}/assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="{{ asset('template/argon') }}/assets/vendor/chart.js/dist/Chart.extension.js"></script>


  <script src="{{ asset('template/argon') }}/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="{{ asset('template/argon') }}/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('template/argon') }}/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="{{ asset('template/argon') }}/assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
  <script src="{{ asset('template/argon') }}/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="{{ asset('template/argon') }}/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="{{ asset('template/argon') }}/assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="{{ asset('template/argon') }}/assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>

  <!-- Argon JS -->
  <script src="{{ asset('template/argon') }}/assets/js/argon.js?v=1.1.0"></script>
  <link href="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css" type="text/css" rel="stylesheet" />
<script src="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>





  <script type="text/javascript">
    var oTable;
    var page = 1;
    $(document).ready(function() {
      oTable = $('#table-report').dataTable({
        pageLength: 10,
        responsive: true,
        dom: 'lrtip',
        order: [[ 0, "asc" ]],
        columnDefs: [
          { orderable: false, targets: 3 },
          { orderable: false, targets: 4 },
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
          url: "{{ route('admin.report') }}",
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
          {data : 'report'},
          {data : 'images'},
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

</body>

</html>