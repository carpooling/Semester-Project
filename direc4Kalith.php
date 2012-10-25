<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Google Maps Location and Routing</title>
      <style type="text/css">
      html { height: 100% }
      body { height: 80%; width:80%; margin: 40; padding: 0 }
      #map_canvas { height: 100% }
    </style>
     <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places,geometry"></script>
	     <script>
      var directionDisplay;
      var directionsService = new google.maps.DirectionsService();
      var map;
	  var place;
	  var placeEnd ;
	  var marker2 ;
	  var image2;
	  var input;
	  var input2;
	  var markerLoaded=false;
	  var rendererOptions = {
			map: map,
			suppressMarkers : true
		}

      function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
        var chicago = new google.maps.LatLng(41.850033, -87.6500523);
        var mapOptions = {
          zoom:7,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          center: chicago, 
		  panControl: false,
		  zoomControl: true,
		  mapTypeControl: false,
		  scaleControl: true,
		  streetViewControl: false,
		  overviewMapControl: false

        }
        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
        directionsDisplay.setMap(map);
		 input = document.getElementById('start');
		 input2 = document.getElementById('end');
		 
		 var autocomplete = new google.maps.places.Autocomplete(input);
		 var autocomplete2 = new google.maps.places.Autocomplete(input2);
		 
		 autocomplete.bindTo('bounds', map);
		  var marker = new google.maps.Marker({
          map: map,
		  animation: google.maps.Animation.DROP});
		  marker2 = new google.maps.Marker({
          map: map,
		  animation: google.maps.Animation.DROP});
		 
		 
        
		 google.maps.event.addListener(autocomplete, 'place_changed', function() {
         
          place = autocomplete.getPlace();
		  
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
		   var image = new google.maps.MarkerImage(
              place.icon,
              new google.maps.Size(71, 71),
              new google.maps.Point(0, 0),
              new google.maps.Point(17, 34),
              new google.maps.Size(35, 35));
          marker.setIcon(image);
          marker.setPosition(place.geometry.location);
		   
		  });
		  google.maps.event.addListener(autocomplete2, 'place_changed', function() {
         
           placeEnd = autocomplete2.getPlace();
         
		   image2 = new google.maps.MarkerImage(
              placeEnd.icon,
              new google.maps.Size(71, 71),
              new google.maps.Point(0, 0),
              new google.maps.Point(17, 34),
              new google.maps.Size(35, 35));

		   
		  });
       
      }

      function calcRoute() {
	  
		
		
        var start = document.getElementById('start').value;
        var end = document.getElementById('end').value;
        var request = {
            origin:start,
            destination:end,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        };
		    marker2.setIcon(image2);
            marker2.setPosition(placeEnd.geometry.location);
            setTimeout(function() {
				marker2.setPosition(placeEnd.geometry.location);
			}, 1600);
			
			var image3='car-symbol-80sq.jpg';
			var marker3 = new google.maps.Marker({
			map: map,
		  animation: google.maps.Animation.DROP,
		  icon:image3,
		  draggable:true
		  });
		  marker3.setPosition(placeEnd.geometry.location);
		  
		  
		  
		  
		  var locat2= new google.maps.LatLng(placeEnd.geometry.location.lat(),placeEnd.geometry.location.lng());
		  var locat1= new google.maps.LatLng(place.geometry.location.lat(),place.geometry.location.lng());
		 var service = new google.maps.DistanceMatrixService();
service.getDistanceMatrix(
  {
    origins: [locat1],
    destinations: [ locat2],
    travelMode: google.maps.TravelMode.DRIVING,
    avoidHighways: false,
    avoidTolls: false
  }, callback);

		 function callback(response, status) {
   if (status == google.maps.DistanceMatrixStatus.OK) {
    var origins = response.originAddresses;
    var destinations = response.destinationAddresses;

    for (var i = 0; i < origins.length; i++) {
      var results = response.rows[i].elements;
      for (var j = 0; j < results.length; j++) {
        var element = results[j];
        var distance = element.distance.text;
        var duration = element.duration.text;
        var from = origins[i];
        var to = destinations[j];
      }
    }
	
	alert("distance from " + from + " to " + to + " is " + distance + " taking " + duration);
  }
}


		 
		 
		 
		
		
        directionsService.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
          }
        });
		}
      
    </script>
  </head>
  <body onload="initialize()">
    <div>
<input id="start" type="textbox">
<input id="end" type="textbox">
<input id="submit" type="button" value="Show Route" onclick=calcRoute();>   
    </div>
    <div id="map_canvas" style="top:30px;"></div>
  </body>
</html>
