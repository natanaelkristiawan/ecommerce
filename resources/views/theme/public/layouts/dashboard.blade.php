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
                    <img class="profile-pic" alt="Image placeholder" src="{{ is_null(Auth::guard('web')->user()->photo) ?  asset('template/argon/assets/img/theme/team-4.jpg') : url('image/profile/'.Auth::guard('web')->user()->photo) }}">
                  </span>
                  <div class="media-body ml-2 d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">{{ Auth::guard('web')->user()->name }}</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="{{ route('public.profile') }}" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item">
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
              <h6 class="h2 text-white d-inline-block mb-0">RG43S Dashboard</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">RG43S Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Default</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    @yield('content')
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
  <!-- Argon JS -->
  <script src="{{ asset('template/argon') }}/assets/js/argon.js?v=1.1.0"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.1/mustache.min.js"></script>
  <style type="text/css">
    ul {
      padding-left: 0;
      list-style: none;

    }
    .nambah-padding ul {
      margin-top: 1.5rem !important;
      margin-bottom: 1.5rem !important;
    }


   
    .product-details {
      float: left;
      width: 50%;
    }
     
    .product-price {
      float: left;
      width: 25%;
    }
     
    .product-line-price {
      float: left;
      width: 25%;
      text-align: right;
    }
     
    /* This is used as the traditional .clearfix class */
    .group:before, .shopping-cart:before, .column-labels:before, .product:before, .totals-item:before,
    .group:after,
    .shopping-cart:after,
    .column-labels:after,
    .product:after,
    .totals-item:after {
      content: '';
      display: table;
    }
     
    .group:after, .shopping-cart:after, .column-labels:after, .product:after, .totals-item:after {
      clear: both;
    }
     
    .group, .shopping-cart, .column-labels, .product, .totals-item {
      zoom: 1;
    }
     
    /* Apply clearfix in a few places */
    /* Apply dollar signs */
    .product .product-price:before, .product .product-line-price:before, .totals-value:before {
      content: 'Rp ';
    }
     
    label {
      color: #aaa;
    }
     
    .shopping-cart {
      margin: 1em 1em 2em 1em;
    }
     
    /* Column headers */
    .column-labels label {
      padding-bottom: 15px;
      margin-bottom: 15px;
      border-bottom: 1px solid #eee;
    }
    .column-labels .product-image, .column-labels .product-details, .column-labels .product-removal {
      text-indent: -9999px;
    }
     
    /* Product entries */
    .product {
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid #eee;
    }
    .product .product-image {
      text-align: center;
    }
    .product .product-image img {
      width: 100px;
    }
    .product .product-details .product-title {
      margin-right: 20px;
      
    }
    .product .product-details .product-description {
      margin: 5px 20px 5px 0;
      line-height: 1.4em;
    }
    .product .product-quantity input {
      width: 40px;
    }
    .product .remove-product {
      border: 0;
      padding: 4px 8px;
      background-color: #c66;
      color: #fff;
      
      font-size: 12px;
      border-radius: 3px;
    }
    .product .remove-product:hover {
      background-color: #a44;
    }
     
    /* Totals section */
    .totals .totals-item {
      float: right;
      clear: both;
      width: 100%;
      margin-bottom: 10px;
    }
    .totals .totals-item label {
      float: left;
      clear: both;
      width: 79%;
      text-align: right;
    }
    .totals .totals-item .totals-value {
      float: right;
      width: 21%;
      text-align: right;
    }
    .totals .totals-item-total {
      
    }
     
    .checkout {
      float: right;
      border: 0;
      margin-top: 20px;
      padding: 6px 25px;

    }
     
    .checkout:hover {
      background-color: #494;
    }
     
    /* Make adjustments for tablet */
    @media screen and (max-width: 650px) {
      .shopping-cart {
        padding: 20px 0;
        border-top: 1px solid #eee;
      }
     
      .column-labels {
        display: none;
      }
     
      .product-image {
        float: right;
        width: auto;
      }
      .product-image img {
        margin: 0 0 10px 10px;
      }
     
      .product-details {
        float: none;
        margin-bottom: 10px;
        width: auto;
      }
     
      .product-price {
        clear: both;
        width: 70px;
      }
     
      .product-quantity {
        width: 100px;
      }
      .product-quantity input {
        margin-left: 20px;
      }
     
      .product-quantity:before {
        content: 'x';
      }
     
      .product-removal {
        width: auto;
      }
     
      .product-line-price {
        float: right;
        width: 70px;
      }
    }
    /* Make more adjustments for phone */
    @media screen and (max-width: 350px) {
      .product-removal {
        float: right;
      }
     
      .product-line-price {
        float: right;
        clear: left;
        width: auto;
        margin-top: 10px;
      }
     
      .product .product-line-price:before {
        content: 'Item Total: $';
      }
     
      .totals .totals-item label {
        width: 60%;
      }
      .totals .totals-item .totals-value {
        width: 40%;
      }

    }
  </style>
  @section('script')
  @show
</body>

</html>