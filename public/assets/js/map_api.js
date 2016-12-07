/*
*@Auth: NongHinh
*/
var socket = io.connect('http://localhost:3000');
var markers = [];
var map;
var mapCanvas = document.getElementById("map");
var newLocation = null;
var infoWindow;

function initMap(){

	var LatLng = new google.maps.LatLng(21.586608, 105.805963);
	var zoom = 11;
	if(active != 0){
		for(var i = 0; i < jsonLocations.length; i++){
			if(jsonLocations[i].id == active){
				var lat = jsonLocations[i].location.split(',')[0];
				var lng = jsonLocations[i].location.split(',')[1];
				console.log(typeof parseFloat(lat));
				console.log(lng);
				LatLng = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
				zoom = 14;
				alert('asdadad');
			}
		}
		console.log(jsonLocations[1]);
	}
	var mapOptions = {
		center: LatLng,
		zoom: zoom,
		styles: [{"featureType":"water","stylers":[{"visibility":"on"},{"color":"#b5cbe4"}]},{"featureType":"landscape","stylers":[{"color":"#efefef"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#83a5b0"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#bdcdd3"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e3eed3"}]},{"featureType":"administrative","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"road"},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":20}]},{},{"featureType":"road","stylers":[{"lightness":20}]}]
	};

	map = new google.maps.Map(mapCanvas, mapOptions);
	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(21.586608, 105.805963),
		title: 'Vị trí hiện tại',
		icon: _dir+'/upload/event/mylocation.png'
	});
	marker.setMap(map);
	if(active == 0){
		geolocation(map, infoWindow);
	}
	showAllMarker();

}
google.maps.event.addDomListener(window, 'load', initMap);

//Show new marker when added new point in map
socket.on('new_location', function(data){
	console.log('new marker ...')
	jsonLocations[jsonLocations.length] = JSON.parse(data);
	addNewMarker(data)
});

//===Update location=====
socket.on('update_location', function(data){
	var dataUpdate = JSON.parse(data);
	if(markers.length > 0){
		for(var i = 0; i < markers.length; i++){
			console.log('A: '+markers[i].getPosition().lng());
			console.log('B: '+dataUpdate.old_lng);
			if(markers[i].getPosition().lat() == dataUpdate.old_lat && markers[i].getPosition().lng() == dataUpdate.old_lng){
				markers[i].setMap(null);
				markers[i] = null;
			}
		}
	}
	addNewMarker(data);
});
//===End Update location=====
/*== Delete location=====*/
socket.on('delete_location', function(data){
	var dataDelete = JSON.parse(data);
	if(markers.length > 0){
		for(var i = 0; i < markers.length; i++){
		
			if(markers[i].getPosition().lat() == dataDelete.lat && markers[i].getPosition().lng() == dataDelete.lng){
				markers[i].setMap(null);
				markers[i] = null;
			}
		}

		for(var i = 0; i < jsonLocations.length; i++){
			if(jsonLocations[i].id == dataDelete.id){
				jsonLocations[i] = null;
			}
		}
	}
});
/*== End Delete location=====*/
/*==  New event ==========*/
socket.on('new_event', function(data){
	var newEvent = JSON.parse(data);
	var locData;

	for(var i = 0; i < jsonLocations.length; i++){
		if(jsonLocations[i].id == newEvent.restaurant_id){
			locData = jsonLocations[i];
		}
	}
	console.log(locData);
	console.log(locData.location);
	$latLngStr = locData.location.split(",");
	$lat = $latLngStr[0];
	$lng = $latLngStr[1];
	$latLngObj = {
		"lat": $lat,
		"lng": $lng
	};

	$newData = Object.assign(locData, $latLngObj);
	if(markers.length > 0){
		for(var i = 0; i < markers.length; i++){

			if(markers[i].getPosition().lat() == $newData.lat && markers[i].getPosition().lng() == $newData.lng){
				markers[i].setMap(null);
				delete markers[i];
			}
		}
	}

	strData = JSON.stringify(locData);

	addNewMarker(strData, newEvent);
});
/*==  END New event ==========*/
/*==  Update event ==========*/
socket.on('update_event', function(data){
	var newEvent = JSON.parse(data);
	var locData;

	for(var i = 0; i < jsonLocations.length; i++){
		if(jsonLocations[i].id == newEvent.restaurant_id){
			locData = jsonLocations[i];
		}
	}
	$latLngStr = locData.location.split(",");
	$lat = $latLngStr[0];
	$lng = $latLngStr[1];
	$latLngObj = {
		"lat": $lat,
		"lng": $lng
	};

	$newData = Object.assign(locData, $latLngObj);
	if(markers.length > 0){
		for(var i = 0; i < markers.length; i++){

			if(markers[i].getPosition().lat() == $newData.lat && markers[i].getPosition().lng() == $newData.lng){
				markers[i].setMap(null);
				delete markers[i];
			}
		}
	}

	strData = JSON.stringify(locData);

	addNewMarker(strData, newEvent);
});
/*==  END Update event ==========*/
/*==  Delete event ==========*/
socket.on('delete_event', function(data){
	var dataDelete = JSON.parse(data);
	if(markers.length > 0){
		for(var i = 0; i < markers.length; i++){
			console.log('Abc: '+markers[i]);
			console.log(markers[i].getPosition().lat());
			console.log(dataDelete.lat);
			console.log(markers[i].getPosition().lng());
			console.log(dataDelete.lng);
			if(markers[i].getPosition().lat() == dataDelete.lat && markers[i].getPosition().lng() == dataDelete.lng){
				console.log('Remove: '+dataDelete.lat);
				markers[i].setMap(null);
				delete markers[i];
				break;
			}
		}

		for(var i = 0; i < jsonEvents.length; i++){
			if(jsonEvents[i].id == dataDelete.id){
				jsonEvents[i] = null;
				break;
			}
		}
	}
	strData = JSON.stringify(dataDelete);
	addNewMarker(strData);
});
/*==  END Delete event ==========*/
function addNewMarker(data, eventRest = null){

	var loc = JSON.parse(data);

	var eventData = null;
	var eventType = null;
	var cateName = null;
	//var LatLng = new google.maps.LatLng(lat, lng);
	if(eventRest == null){
		for(var k = 0; k < jsonEvents.length; k++){
			if(jsonEvents[k]){
				if(jsonEvents[k].restaurant_id == data.id){
					eventData = jsonEvents[k];
					break;
				}
			}
		}
	}
	else{
		eventData = eventRest;
	}
	if(eventData != null){
		for(var k = 0; k < jsonEventType.length; k++){
			if(eventData.event_id == jsonEventType[k].id){
				eventType = jsonEventType[k].name;
				break;
			}
		}

		for(var k = 0; k < jsonCates.length; k++){
			if(eventData.cate_id == jsonCates[k].id){
				cateName = jsonCates[k].name;
				break;
			}
		}
	}
	var icon = _dir+'/upload/event/icon.png';
	if(eventData != null){
		for(var i = 0; i < jsonEventType.length; i++){
			if(eventData.event_id == jsonEventType[i].id){
				icon = _dir+'/upload/event/'+jsonEventType[i].icon;
			}
		}
	}
	var newMarker =  new google.maps.Marker({
		position: new google.maps.LatLng(parseFloat(loc.lat), parseFloat(loc.lng)),
		title: loc.name,
		icon: icon,
		map: map
	});

	showInfo(newMarker, loc, eventData, eventType, cateName);
	markers.push(newMarker);
	jsonLocations.push(loc);
}
//function show infomation of marker when we click to it
function showInfo(marker, data, eventData, eventType, cateName){
	marker.addListener('click', function(){
		window.history.pushState("", "", _dir+'?slug='+data.slug+'&id='+data.id);
		map.panTo(new google.maps.LatLng(this.position.lat(), this.position.lng()))
		smoothZoom(map, 15, map.getZoom());
		this.setAnimation(google.maps.Animation.BOUNCE);
		var infoContent = '';
			infoContent += '<p><strong>'+data.name+'</strong></p>';
			infoContent += '<a href="#modalInfoMarker" class="btn btn-flat">Chi tiết</a>';
		infoWindow = new google.maps.InfoWindow({
			map: map,
			content: infoContent,
			position: this.position
		});
		$('#modalInfoMarker .pointContent').html(data.address);
		$('#modalInfoMarker .coverImg').attr('src', _dir+'/upload/covers/'+data.cover_image);
		$('#modalInfoMarker #basicInfo .location').html(data.name);
		$('#modalInfoMarker #basicInfo .address').html(data.address);
		$('#modalInfoMarker #basicInfo .email').html(data.email);
		$('#modalInfoMarker #basicInfo .phone').html(data.phone);
		$('#modalInfoMarker #basicInfo .website').html(data.website);
		var starttime = data.opening_time == ':' ? '00:00' : data.opening_time;
		var endtime = data.closing_time == ':' ? '00:00' : data.closing_time;
		var worktime = '<strong>Từ :<strong>'+starttime+'<strong> đến: </strong>'+endtime;
		$('#modalInfoMarker #basicInfo .description').html(data.opening_time);
		$('#modalInfoMarker #basicInfo .capacity').html(data.capacity);
		$('#modalInfoMarker #basicInfo .work_time').html(worktime);

		if(eventData != null && eventType != null && cateName != null){
			$('#modalInfoMarker #eventInfo .pointBody').show();
			$('#modalInfoMarker #eventInfo .alert').html('');
			$('#modalInfoMarker #basicInfo .last_order_time').html(data.last_order_time);
			$('#modalInfoMarker #basicInfo .price').html('<strong>Từ: </strong>'+data.min_price+' <strong>đến :</strong>'+data.max_price);
			$('#modalInfoMarker #eventInfo .eventname').html(eventData.name);
			$('#modalInfoMarker #eventInfo .eventtype').html(eventType);
			$('#modalInfoMarker #eventInfo .eventcate').html(cateName);
			$('#modalInfoMarker #eventInfo .eventinfo').html(eventData.info_event);
			$('#modalInfoMarker #eventInfo .starttime').html(eventData.start_time);
			$('#modalInfoMarker #eventInfo .endtime').html(eventData.end_time);
		}
		else{
			$('#modalInfoMarker #eventInfo .pointBody').hide();
			$('#modalInfoMarker #eventInfo .alert').html('Không có sự kiện');
		}
		
		//$('#modalInfoMarker').modal('open');
	});
}


function showAllMarker(){
	var url = _dir+'/getevent';
	for(var i = 0; i < jsonLocations.length; i++){

		var coor = jsonLocations[i].location.split(",");
		var lat = parseFloat(coor[0]);
		var lng = parseFloat(coor[1]);
		var eventData = null;
		var eventType = null;
		var cateName = null;
		var LatLng = new google.maps.LatLng(lat, lng);
		for(var k = 0; k < jsonEvents.length; k++){
			if(jsonEvents[k].restaurant_id == jsonLocations[i].id){
				eventData = jsonEvents[k];
				break;
			}
		}
		var mark = addMarker(LatLng, jsonLocations[i], eventData,jsonEventType);
		if(eventData != null){
			for(var k = 0; k < jsonEventType.length; k++){
				if(eventData.event_id == jsonEventType[k].id){
					eventType = jsonEventType[k].name;
					break;
				}
			}

			for(var k = 0; k < jsonCates.length; k++){
				if(eventData.cate_id == jsonCates[k].id){
					cateName = jsonCates[k].name;
					break;
				}
			}
		}
		showInfo(mark, jsonLocations[i], eventData, eventType, cateName);
		
	}
	setAllMap();
}
function addMarker(location, data, eventData, jsonEventType) {
	var icon = _dir+'/upload/event/icon.png';
	if(eventData != null){
		for(var i = 0; i < jsonEventType.length; i++){
			if(eventData.event_id == jsonEventType[i].id){
				icon = _dir+'/upload/event/'+jsonEventType[i].icon;
			}
		}
	}
	var marker = new google.maps.Marker({
        position: location,
        title: data.name,
        icon: icon,
    });

    markers.push(marker);
    return marker;
}
 // Thiết lập bản đồ cho tất cả markers
function setAllMap() {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}

function clearMarkers() {
    setAllMap(null);
}
 // Xóa tất cả marker ra khỏi bộ nhớ
function deleteMarkers() {
    clearMarkers();
    markers = [];
}

//Tìm vị trí của client sử dụng 
function geolocation(map, infoWindow){
	// Try HTML5 geolocation.
	if (navigator.geolocation) {
	  navigator.geolocation.getCurrentPosition(function(position) {
	    var pos = {
	      lat: position.coords.latitude,
	      lng: position.coords.longitude
	    };

	    // infoWindow.setPosition(pos);
	    // infoWindow.setContent('Bạn đang ở đây.');
	    map.setCenter(pos);
	  }, function() {
	    handleLocationError(true, infoWindow, map.getCenter());
	  });
	} else {
	  // Browser doesn't support Geolocation
	  handleLocationError(false, infoWindow, map.getCenter());
	}
}
	
// Điều khiển lỗi nếu trình duyệt không hỗ trợ
 function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
                          'Error: The Geolocation service failed.' :
                          'Error: Your browser doesn\'t support geolocation.');
}

//Smooth zoom
function smoothZoom (map, max, cnt) {
    if (cnt >= max) {
        return;
    }
    else {
        z = google.maps.event.addListener(map, 'zoom_changed', function(event){
            google.maps.event.removeListener(z);
            smoothZoom(map, max, cnt + 1);
        });
        setTimeout(function(){map.setZoom(cnt)}, 80); // 80ms is what I found to work well on my system -- it might not work well on all systems
    }
}  

//Get latlngitube form address
 function GetLocation(address) {
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            alert("Latitude: " + latitude + "\nLongitude: " + longitude);
        } else {
            alert("Request failed.")
        }
    });
};

function rad(x) {return x*Math.PI/180;}
function find_closest_marker( event ) {
    var lat = event.latLng.lat();
    var lng = event.latLng.lng();
    var R = 6371; // radius of earth in km
    var distances = [];
    var closest = -1;
    for( i=0;i<map.markers.length; i++ ) {
        var mlat = map.markers[i].position.lat();
        var mlng = map.markers[i].position.lng();
        var dLat  = rad(mlat - lat);
        var dLong = rad(mlng - lng);
        var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(rad(lat)) * Math.cos(rad(lat)) * Math.sin(dLong/2) * Math.sin(dLong/2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        var d = R * c;
        distances[i] = d;
        if ( closest == -1 || d < distances[closest] ) {
            closest = i;
        }
    }
}