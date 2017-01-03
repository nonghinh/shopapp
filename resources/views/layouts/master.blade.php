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
	<div id="fb-root"></div>
	<!-- FB comment -->
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1702546126725372";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<!-- END FB comment -->
	@include('frontend.blocks.header')
	@include('frontend.blocks.sidenav')
	<section id="page-content">
		@yield('content')
	</section>
	<!-- Modal about us -->
	<div id="aboutus" class="modal">
	    <div class="modal-content">
	      <h4>Giới thiệu</h4>
	      <p>Website được lập ra với mục đích kết nối các địa điểm cửa hàng ăn uống lại, thuận tiện cho việc tìm kiếm, tra cứu thông tin cửa hàng của mọi người, qua đó nhanh chóng tìm kiếm nơi ăn uống theo yêu cầu người dùng gần nhất. Chúng tôi luôn luôn cập nhật thông tin, cải thiện công nghệ giúp người dùng có thể dễ dàng, thuận tiện trong việc tìm kiếm các cửa hàng ăn uống gần nhất.</p>
	    </div>
	    <div class="modal-footer">
	      <a href="javascript:void(0)" class=" modal-action modal-close waves-effect waves-green btn-flat">Thoát</a>
	    </div>
	 </div>
	<!-- END Modal about us -->
	<script type="text/javascript" src="{!! url('assets/vendors/jquery/dist/jquery.min.js') !!}"></script>
	<script type="text/javascript" src="{!! url('assets/js/materialize.min.js') !!}"></script>
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