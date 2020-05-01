<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Start Your Business With Our Services.">
<meta name="author" content="Creative Tim">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>RG43S Dashboard</title>
<!-- Favicon -->
<link rel="icon" href="{{ asset('template/argon') }}/assets/img/brand/favicon.png" type="image/png">
<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
<!-- Icons -->
<link rel="stylesheet" href="{{ asset('template/argon') }}/assets/vendor/nucleo/css/nucleo.css" type="text/css">
<!-- Page plugins -->
<link rel="stylesheet" href="{{ asset('template/argon') }}/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
<link rel="stylesheet" href="{{ asset('template/argon') }}/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('template/argon') }}/assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('template/argon') }}/assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('template/argon') }}/additionals/switchery/switchery.css">
<link rel="stylesheet" href="{{ asset('template/argon') }}/additionals/toastr/toastr.min.css">
<link rel="stylesheet" href="{{ asset('template/argon') }}/additionals/bootstrap-tagsinput/bootstrap-tagsinput.css">
<link rel="stylesheet" href="{{ asset('template/argon') }}/additionals/summernote/summernote-bs4.css">


<!-- Page plugins -->
<link rel="stylesheet" href="{{ asset('template/argon') }}/assets/vendor/animate.css/animate.min.css">
<link rel="stylesheet" href="{{ asset('template/argon') }}/assets/vendor/sweetalert2/dist/sweetalert2.min.css">


<!-- Argon CSS -->
<link rel="stylesheet" href="{{ asset('template/argon') }}/assets/css/argon.css?v=1.1.0" type="text/css">
<link rel="stylesheet" href="{{ asset('template/argon') }}/additionals/chosen/bootstrap-chosen.css">
<link href="{{ asset('template/argon') }}/additionals/dropzone/basic.min.css" rel="stylesheet">
<link href="{{ asset('template/argon') }}/additionals/dropzone/dropzone.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('template/argon') }}/additionals/style/additional.css">
<script src="{{ asset('template/argon') }}/assets/vendor/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('package') }}/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('package') }}/dist/sweetalert2.css">

<style type="text/css">
  table {
    width: 100% !important;
  }
  .has-danger .form-control {
    border-color: #f5365c;
  }

   .has-danger .form-control::placeholder {
    color: #adb5bd;
  }

  .has-danger .help-block {
    color: #f5365c;
   }

  .bootstrap-tagsinput { 
    border: 1px solid #dee2e6;
    box-shadow: none;
    display: block;
   }

   .dz-message {
      z-index: 999;
      padding: 0;
      cursor: pointer;
      transition: all .15s ease;
      text-align: center;
      color: #212529;
      border: 0 !important;
      border-radius: 0 !important;
      background-color: transparent;
      order: -1;
   }

</style>

<script type="text/javascript">
    var TOKEN = {'_token' : "{{ csrf_token() }}"};
</script>


<style type="text/css">
  .navbar-vertical .navbar-brand-img, .navbar-vertical .navbar-brand > img {
    max-height: none;
  }
  .sidenav .navbar-brand{
    padding: 0px !important;
    margin-top: 20px;
    margin-left: 20px;
  }

  @media(max-width: 600px){
    .navbar-vertical .navbar-brand-img, .navbar-vertical .navbar-brand > img {
      max-height: 3em;
    }
    .sidenav .navbar-brand{
      padding: 0px !important;
      margin-top: 0px;
      margin-left: 10px;
    }
  }
</style>
@section('style')
@show