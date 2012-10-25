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
     <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
    <script>
      var directionDisplay;
      var directionsService = new google.maps.DirectionsService();
      var map;
	  var placeEnd ;
	  var marker2 ;
	  var image2;
	 

      function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        var chicago = new google.maps.LatLng(41.850033, -87.6500523);
        var mapOptions = {
          zoom:7,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          center: chicago
        }
        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
        directionsDisplay.setMap(map);
		 var input = document.getElementById('start');
		 var input2 = document.getElementById('end');
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
         
          var place = autocomplete.getPlace();
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
		setTimeout(function() {
		 marker2.setPosition(placeEnd.geometry.location);
      }, 1000);

         
		   
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
