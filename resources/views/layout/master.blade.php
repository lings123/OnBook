<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>@yield('title')</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name=csrf-token content="{{csrf_token()}}">
	<!-- Favicons -->
	<link rel="shortcut icon" href="{{URL('public/images/favicon.ico')}}">
	<link rel="apple-touch-icon" href="{{URL('public/images/icon.png')}}">

	<!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 

	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{URL('public/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL('public/css/plugins.css')}}">
	<link rel="stylesheet" href="{{URL('public/style.css')}}">

	<!-- Cusom css -->
   <link rel="stylesheet" href="{{URL('public/css/custom.css')}}">

	<!-- Modernizer js -->
	<script src="{{URL('public/js/vendor/modernizr-3.5.0.min.js')}}"></script>

	 <!-- DataTables CSS -->
	 <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>
	<div class="wrapper" id="wrapper">
	@include('layout.header')
	@yield('content')

	@include('layout.footer')
	
	<!-- //Main wrapper -->

	<!-- JS Files -->
	
	<script src="{{URL('public/js/vendor/jquery-3.2.1.min.js')}}"></script>
	<script src="{{URL('public/js/popper.min.js')}}"></script>
	<script src="{{URL('public/js/bootstrap.min.js')}}"></script>
	<script src="{{URL('public/js/plugins.js')}}"></script>
	<script src="{{URL('public/js/active.js')}}"></script>
	
	 <!-- DataTables JavaScript -->
	 <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	 @yield('script')
	 <script>
		$(document).ready(function() {
			$('#example').DataTable( {
				"order": [[ 3, "desc" ]]
			} );
		
} );
		</script>
	
</body>
</html>
