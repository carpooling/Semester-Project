<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Google Maps JavaScript API v3 Example: Geocoding Simple</title>
    <style type="text/css">
  html { height: 100% }
  body { width: 60%;height: 100%; margin: 0; padding: 0 }
  #map_canvas { height: 40% }
</style>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script>
      var geocoder;
      var map;
	  var markerBounds=[];
      function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(40.713956,-100.283203);
        var mapOptions = {
          zoom: 4,
          center: latlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
      }

      function codeAddress() {
        var address1 = document.getElementById('address1').value;
        geocoder.geocode( { 'address': address1}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
			map.setZoom(4);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
			
            }
			
			);
			var myLatLng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());       
			markerBounds.push(myLatLng);
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
		var address2 = document.getElementById('address2').value;
        geocoder.geocode( { 'address': address2}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) 
		  {
            //map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
				
            }
			
			);
			var myLatLng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()); 
			markerBounds.push(myLatLng);
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
		
		var latlngbounds = new google.maps.LatLngBounds();
        for ( var i = 0; i < markerBounds.length; i++ ) {
           latlngbounds.extend(markerBounds[i]);
        }
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds);
				
      }
    </script>
  </head>
  <body onload="initialize()">
    <div>
      <input id="address1" type="textbox" value="">
	  <input id="address2" type="textbox" value="">
      <input type="button" value="Geocode" onclick="codeAddress()">
    </div>
    <div id="map_canvas" style="height:90%;top:30px"></div>
  </body>
</html>


