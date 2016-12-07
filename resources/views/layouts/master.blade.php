<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title') - Tìm kiếm các quán ăn gần bạn nhất</title>
	<link rel="stylesheet" href="{!! url('assets/css/materialize.min.css')!!}">
	<link rel="stylesheet" href="{!! url('assets/css/style.css')!!}">
	<link rel="stylesheet" href="{!! url('assets/css/material-icon.css')!!}">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
	
	@include('frontend.blocks.header')
	@include('frontend.blocks.sidenav')
	<section id="page-content">
		@yield('content')
	</section>
	<script type="text/javascript" src="{!! url('assets/vendors/jquery/dist/jquery.min.js') !!}"></script>
	<script type="text/javascript" src="{!! url('assets/js/materialize.js') !!}"></script>
	<script type="text/javascript">
		var _dir = "{!! url('/') !!}";
	</script>
	<script type="text/javascript" src="{!! url('assets/js/custom.js') !!}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFVr8rsiRRbNFyYoavdPOyjsQeq6g5fnU"></script>
	<script src="{!! url('assets/js/socket.io-1.4.5.js') !!}"></script>
	@yield('footer')
	<script type="text/javascript" src="{!! url('assets/js/map_api.js') !!}"></script>
	<script type="text/javascript" src="{!! url('assets/js/geolocation.js') !!}"></script>
</body>
</html>