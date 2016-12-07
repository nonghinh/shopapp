function geoMap(){
	var canvas = document.getElementById('geoMap');
	var mapOptions = {
		zoom: 9,
		center: new google.maps.LatLng(21.586608, 105.805963),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		styles: [{"featureType":"water","stylers":[{"visibility":"on"},{"color":"#b5cbe4"}]},{"featureType":"landscape","stylers":[{"color":"#efefef"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#83a5b0"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#bdcdd3"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e3eed3"}]},{"featureType":"administrative","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"road"},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":20}]},{},{"featureType":"road","stylers":[{"lightness":20}]}]
	};

	var myMap = new google.maps.Map(canvas, mapOptions);

	var myMarker = new google.maps.Marker({
	    position: new google.maps.LatLng(21.586608, 105.805963),
	    draggable: true
	});
	var latlng = "";
	google.maps.event.addListener(myMarker, 'dragend', function(evt){
		latlng = evt.latLng.lat() + ',' + evt.latLng.lng();
		document.getElementById('location').value = latlng;
    	document.getElementById('locate').innerHTML = ''+evt.latLng.lat() + ', ' + evt.latLng.lng();
	});

	google.maps.event.addListener(myMarker, 'dragstart', function(evt){
	    document.getElementById('locate').innerHTML = 'Currently dragging marker...';
	});

	myMap.setCenter(myMarker.position);
	myMarker.setMap(myMap);
}
$('#btnGeo').click(function(evt) {
	$('#getLocation').modal('open');
	geoMap();
});
$('#btnGeo').click(function(evt) {
	$('#getLocation').modal('open');
	geoMap();
});
