<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{!! Meta::get('title') !!}</title>
  <meta content="{!! Meta::get('title') !!}" name ="title"> 
  <meta content="{!! Meta::get('description') !!}" name ="description"> 
  <meta content="{!! Meta::get('tag') !!}" name ="tag"> 

  <!-- Favicons -->
  <link href="{{ asset('template/ecommerce') }}/assets/img/resize.png" rel="icon">
  <link href="{{ asset('template/ecommerce') }}/assets/img/resize.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('template/ecommerce') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('template/ecommerce') }}/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="{{ asset('template/ecommerce') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset('template/ecommerce') }}/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="{{ asset('template/ecommerce') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ asset('template/ecommerce') }}/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="{{ asset('template/ecommerce') }}/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('template/ecommerce') }}/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Bootslander - v2.0.0
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  @yield('content')

  <!-- Vendor JS Files -->
  <script src="{{ asset('template/ecommerce') }}/assets/vendor/jquery/jquery.min.js"></script>
  <script src="{{ asset('template/ecommerce') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('template/ecommerce') }}/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="{{ asset('template/ecommerce') }}/assets/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset('template/ecommerce') }}/assets/vendor/venobox/venobox.min.js"></script>
  <script src="{{ asset('template/ecommerce') }}/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="{{ asset('template/ecommerce') }}/assets/vendor/counterup/counterup.min.js"></script>
  <script src="{{ asset('template/ecommerce') }}/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="{{ asset('template/ecommerce') }}/assets/vendor/TweenMax/TweenMax.min.js"></script>
  <script src="{{ asset('template/ecommerce') }}/assets/vendor/wavify/wavify.js"></script>
  <script src="{{ asset('template/ecommerce') }}/assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('template/ecommerce') }}/assets/js/main.js"></script>

</body>

</html>