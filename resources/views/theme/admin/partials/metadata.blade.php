<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
<meta name="author" content="Creative Tim">
<title>Argon Dashboard PRO - Premium Bootstrap 4 Admin Template</title>
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


<!-- Page plugins -->
<link rel="stylesheet" href="{{ asset('template/argon') }}/assets/vendor/animate.css/animate.min.css">
<link rel="stylesheet" href="{{ asset('template/argon') }}/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
<!-- Argon CSS -->
<link rel="stylesheet" href="{{ asset('template/argon') }}/assets/css/argon.css?v=1.1.0" type="text/css">


<style type="text/css">
  table {
    width: 100% !important;
  }
</style>

<script type="text/javascript">
    var TOKEN = {'_token' : "{{ csrf_token() }}"};
</script>

@section('style')
@show