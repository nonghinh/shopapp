<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DEMO</title>
</head>
<body>
	<p id="power">0</p>
	<script src="{!! url('assets/vendors/jquery/dist/jquery.min.js') !!}"></script>
	<script type="text/javascript" src="{!! url('assets/js/socket.io-1.4.5.js') !!}"></script>
	<script type="text/javascript">
		var socket = io('http://localhost:3000');
        //var socket = io('http://192.168.10.10:3000');

        socket.on("test-channel:App\\Events\\EventDemo", function(message){
            // increase the power everytime we load test route
            $('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
            console.log(100);
        });
	</script>
</body>
</html>