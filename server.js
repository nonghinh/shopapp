var app = require('express')();
var server = require('http').createServer(app);
var io = require('socket.io')(server);
var redis = require('redis');
var jsonfile = require('jsonfile');

var port = process.env.PORT || 3000;

server.listen(port, function(){
	console.log('Server running at port %d ...', port);
});

io.on('connection', function(socket){
	console.log('Client connected');
	var redisClient = redis.createClient();

	redisClient.subscribe('new_location');
	redisClient.on('message', function(chanel, data){
		console.log('message added to queue '+data+' chanel '+chanel);
		console.log('==============================');
		socket.emit(chanel, data);
	});

	redisClient.subscribe('update_location');
	redisClient.subscribe('delete_location');
	redisClient.subscribe('new_event');
	redisClient.subscribe('update_event');
	redisClient.subscribe('delete_event');
	
	socket.on('disconnect', function(){
		console.log('client disconnected');
		redisClient.quit();
	});
});