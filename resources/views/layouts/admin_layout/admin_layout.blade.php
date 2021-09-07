<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Commerce Admin</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->

  @if(parse_url(url('/'), PHP_URL_SCHEME) == 'HTTPS')
        <link rel="stylesheet" href="{{ secure_asset('plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ secure_asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ secure_asse('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('plugins/jqvmap/jqvmap.min.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/admin_css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('plugins/daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('plugins/summernote/summernote-bs4.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
  @else
		<link rel="stylesheet" href="{{url('plugins/fontawesome-free/css/all.min.css')}}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      
      <!-- DataTables -->
      <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

      <!-- Select2 -->
      <link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css') }}">

      <!-- Tempusdominus Bbootstrap 4 -->
      <link rel="stylesheet" href="{{url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
      <!-- iCheck -->
      <link rel="stylesheet" href="{{url('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
      <!-- JQVMap -->
      <link rel="stylesheet" href="{{url('plugins/jqvmap/jqvmap.min.css')}}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{url('css/admin_css/adminlte.min.css')}}">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="{{url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="{{url('plugins/daterangepicker/daterangepicker.css')}}">
      <!-- summernote -->
      <link rel="stylesheet" href="{{url('plugins/summernote/summernote-bs4.css')}}">
      <!-- Google Font: Source Sans Pro -->
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @endif
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

@include('layouts.admin_layout.admin_header')

@include('layouts.admin_layout.admin_sidebar')

@yield('content')


@include('layouts.admin_layout.admin_footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


@if(parse_url(url('/'), PHP_URL_SCHEME) == 'HTTPS')
        <script src="{{ secure_asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ secure_asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    @else
        <!-- jQuery -->
        <script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{url('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
@endif 


<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

@if(parse_url(url('/'), PHP_URL_SCHEME) == 'HTTPS')
        <script src="{{ secure_asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ secure_asset('plugins/select2/js/select2.full.min.js') }}"></script>
    @else
       <!-- Bootstrap 4 -->
      <script src="{{url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- Select2 -->
      <script src="{{url('plugins/select2/js/select2.full.min.js') }}"></script>
@endif 


<script>
  $('.select2').select2();
</script>

@if(parse_url(url('/'), PHP_URL_SCHEME) == 'HTTPS')
        <script src="{{ secure_asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ secure_asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    @else
    <script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    
@endif 

<script>
  $(function () {
    $("#sections").DataTable();
    $("#categories").DataTable();
    $("#products").DataTable();
    $("#users").DataTable();
    $("#cmspages").DataTable();
  });
</script>


@if(parse_url(url('/'), PHP_URL_SCHEME) == 'HTTPS')
        <script src="{{ secure_asset('plugins/chart.js/Chart.min.js') }}"></script>
        <script src="{{ secure_asset('plugins/sparklines/sparkline.js') }}"></script>
        <script src="{{ secure_asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ secure_asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
        <script src="{{ secure_asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
        <script src="{{ secure_asset('plugins/moment/moment.min.js') }}"></script>
        <script src="{{ secure_asset('plugins/inputmask/jquery.inputmask.bundle.js') }}"></script>
        <script src="{{ secure_asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ secure_asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <script src="{{ secure_asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
        <script src="{{ secure_asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <script src="{{ secure_asset('js/admin_js/adminlte.js') }}"></script>
        <script src="{{ secure_asset('js/admin_js/pages/dashboard.js')  }}"></script>
        <script src="{{ secure_asset('js/admin_js/demo.js') }}"></script>
        <script src="{{ secure_asset('js/admin_js/admin_script.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @else
    
    <!-- ChartJS -->
    <script src="{{url('plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{url('plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{url('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{url('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{url('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{url('plugins/moment/moment.min.js')}}"></script>

    <script src="{{url('plugins/inputmask/jquery.inputmask.bundle.js')}}"></script>

    <script src="{{url('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{url('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('js/admin_js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ url('js/admin_js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('js/admin_js/demo.js') }}"></script>

    <!--  Custom Admin JS -->
    <script src="{{ url('js/admin_js/admin_script.js') }}"></script>
    {{-- Sweet Alert Script--}}
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endif 

</body>
</html>
