var markers = [];
var map = null;
var myPoints = [];
var myRegion = null;

function initMap(lat = 24.163669, lng = 120.637566)
{
	var myPosition =  new google.maps.LatLng(lat, lng);
	var image = {
	    url: 'gps.png',
	    scaledSize: new google.maps.Size(60, 60),
	};
	
	/*** 製作地圖 ***/
	var mapProp = {
		center: myPosition,
		zoom:18,
		mapTypeId:google.maps.MapTypeId.ROADMAP,
		mapTypeControl: false
	};

	map = new google.maps.Map(document.getElementById('map'), mapProp);

	/*** 顯示自訂介面 ***/
	var searchBar = document.getElementById('searchBar');
	map.controls[google.maps.ControlPosition.TOP_LEFT].push(searchBar);
	
	/*** 顯示滑鼠目前的經緯度 ***/
	/*
	var coordsDiv = document.getElementById('coords');
	map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push(coordsDiv);
	map.addListener('mousemove', function(event) {
	document.getElementById('coords').textContent =
	    'lat: ' + event.latLng.lat().toFixed(5) + ', ' +
	    'lng: ' + event.latLng.lng().toFixed(5);
	});
	*/

	/*** 設定地圖樣式 ***/ 
	var stylesArray = [
		{
			'featureType': 'landscape.man_made',
			'elementType': 'geometry.fill',
			'stylers': [
				{ 'color': '#1e1a03' }
			]
		},
		{
		  	'featureType': 'landscape.natural',
			'elementType': 'all',
			'stylers': [
				{ 'color': '#146d5f' }
			]
		},
		{
		  	'featureType': 'road',
			'elementType': 'geometry.fill',
			'stylers': [
				{ 'color': '#ffc10a' },
				{ 'saturation': 3 }
			]
		},
		{
		  	'featureType': 'road',
			'elementType': 'labels.text',
			'stylers': [
				{ 'color': '#090eb7' },
				{ 'weight': 0.1 }
			]
		}
	];

	map.setOptions({styles: stylesArray});

	/*** 設定定位圖案 ***/
	var marker = new google.maps.Marker({
		position: myPosition,
		animation:google.maps.Animation.BOUNCE,
		draggable:true,
		icon: image,
	});
	marker.setMap(map);
	markers.push(marker);


	myPoints = [];
    myRegion = new google.maps.Polygon({
        paths: myPoints,
        fillColor: '#4fe',
        fillOpacity: 0.5,
        strokeColor: 'white',
        strokeWeight: 0.5,
        map:map
      });

    var setRegion = function(e) {
      if(google.maps.geometry.poly.containsLocation(e.latLng, myRegion))
      {
        return;
      }

      myPoints.push(e.latLng.toJSON());
      if(myRegion) myRegion.setMap(null);
      myRegion = new google.maps.Polygon({
        paths: myPoints,
        fillColor: 'purple',
        fillOpacity: 0.5,
        strokeColor: 'white',
        strokeWeight: 0.5,
        scale: 1,
        map:map
      });
      markers.push(new google.maps.Marker({
        position: e.latLng,
        map: map,
        icon: image
      }));
    };

    var geocoder = new google.maps.Geocoder();

	function geocodeAddress(geocoder, resultsMap) {
	  var address = document.getElementById('pac-input').value;
	  geocoder.geocode({'address': address}, function(results, status) {
	    if (status === google.maps.GeocoderStatus.OK) {
	      resultsMap.setCenter(results[0].geometry.location);
	      markers.push(new google.maps.Marker({
	        map: resultsMap,
	        position: results[0].geometry.location,
	        animation:google.maps.Animation.BOUNCE,
	        icon: image
	      }));
	    } else {
	      alert('Geocode was not successful for the following reason: ' + status);
	    }
	  });
	}

	document.getElementById('search').addEventListener('click', function() {
    	geocodeAddress(geocoder, map);
  	});


    google.maps.event.addListener(map, 'click', setRegion);
}


function clean()
{
	for (var i in markers) {
		markers[i].setMap(null);
	}

	var len = myPoints.length;
	for (var i = 0; i < len; i++) {
		myPoints.pop();
	}

	myRegion.setMap(null);

	display();
}

function display()
{
	var message = document.getElementById('message');

	if (myPoints.length === 0) { message.innerHTML = ''; return;}
	var output = '<div class="w3-example"><h3>項點座標</h3><div class="w3-code jsHigh notranslate">[<ul style="list-style-type:none">';
	for(var i in myPoints)
	{
		output += "<li>{ x: '" + myPoints[i].lat + "', y: '" + myPoints[i].lng + "' },</li>"
	}

	output += '</ul>]</div></div>';
	message.innerHTML = output;
}
