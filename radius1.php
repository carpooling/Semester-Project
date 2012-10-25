<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <title>Google Maps AJAX + mySQL/PHP Example</title>
      <style type="text/css">
      html { height: 100% }
      body { height: 80%; width:80%; margin: 40; padding: 0 }
      #map_canvas { height: 100% }
    </style>
     <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
    <script type="text/javascript">
    
		var map;
		var markers = [];
		var infoWindow;
		var locationSelect;
		var directionDisplay;
		var directionsService = new google.maps.DirectionsService();
		var place;
		var placeEnd ;
		var marker2 ;
		var image2;
		var markerLoaded=false;
		var rendererOptions = {
			map: map,
			suppressMarkers : true
		}
		
		var contentString1;
		var contentString2;
		
		
    function load() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
        var chicago = new google.maps.LatLng(41.850033, -87.6500523);
        var mapOptions = {
          zoom:7,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          center: chicago, 
		  panControl: false,
		zoomControl: true,
			mapTypeControl: true,
			scaleControl: true,
			streetViewControl: false,
			overviewMapControl: false

        }
      infoWindow = new google.maps.InfoWindow();
      locationSelect = document.getElementById("locationSelect");
      locationSelect.onchange = function() {
        var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
        if (markerNum != "none"){
          google.maps.event.trigger(markers[markerNum], 'click');
        }
      };
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
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

   function searchLocations() {
     var address = document.getElementById("start").value;
     var geocoder = new google.maps.Geocoder();
     geocoder.geocode({address: address}, function(results, status) {
       if (status == google.maps.GeocoderStatus.OK) {
        searchLocationsNear(results[0].geometry.location);
       } else {
         alert(address + ' not found');
       }
     });
   }

   function clearLocations() {
     infoWindow.close();
     for (var i = 0; i < markers.length; i++) {
       markers[i].setMap(null);
     }
     markers.length = 0;

     locationSelect.innerHTML = "";
     var option = document.createElement("option");
     option.value = "none";
     option.innerHTML = "See all results:";
     locationSelect.appendChild(option);
   }

   function searchLocationsNear(center) {
     clearLocations(); 
     

     var radius = document.getElementById('radiusSelect').value;
     var searchUrl = 'phpsqlsearch_genxml.php?lat=' + center.lat() + '&lng=' + center.lng() + '&radius=' + radius;
     downloadUrl(searchUrl, function(data) {
       var xml = parseXml(data);
       var markerNodes = xml.documentElement.getElementsByTagName("marker");
       var bounds = new google.maps.LatLngBounds();
       for (var i = 0; i < markerNodes.length; i++) {
         var name = markerNodes[i].getAttribute("name");
         var address = markerNodes[i].getAttribute("address");
         var distance = parseFloat(markerNodes[i].getAttribute("distance"));
         var latlng = new google.maps.LatLng(
              parseFloat(markerNodes[i].getAttribute("lat")),
              parseFloat(markerNodes[i].getAttribute("lng")));

         createOption(name, distance, i);
         (function(a,b,c) {
			setTimeout(function() { createMarker(a, b,c); }, 200*i);
			})(latlng, name, address);
         bounds.extend(latlng);
       }
       map.fitBounds(bounds);
       locationSelect.style.visibility = "visible";
       locationSelect.onchange = function() {
         var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
         google.maps.event.trigger(markers[markerNum], 'click');
       };
      });
    }
  
    function createMarker(latlng, name, address) {
      var html = "<b>" + name + "</b> <br/>" + address;
      var marker = new google.maps.Marker({
        map: map,
        icon:'green.png',
		animation: google.maps.Animation.DROP,
        position: latlng
      });
 
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
      markers.push(marker);
    }

    function createOption(name, distance, num) {
      var option = document.createElement("option");
      option.value = num;
      option.innerHTML = name + "(" + distance.toFixed(1) + ")";
      locationSelect.appendChild(option);
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request.responseText, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function parseXml(str) {
      if (window.ActiveXObject) {
        var doc = new ActiveXObject('Microsoft.XMLDOM');
        doc.loadXML(str);
        return doc;
      } else if (window.DOMParser) {
        return (new DOMParser).parseFromString(str, 'text/xml');
      }
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
			}, 1600);
			
			
			var image3='green.png';
			var image4='red.png';
			var marker3 = new google.maps.Marker({
			map: map,
		  animation: google.maps.Animation.DROP,
		  icon:image3,
		  draggable:true
		  });
		  var marker4 = new google.maps.Marker({
			map: map,
		  animation: google.maps.Animation.DROP,
		  icon:image4,
		  draggable:true
		  });
		 setTimeout(function() {
				marker3.setPosition(place.geometry.location);
			}, 1800); 
			setTimeout(function() {
				marker4.setPosition(place.geometry.location);
			}, 2000); 
			
			contentString1=" Car 1: Going from "+ start+ " to " + end + "<br />" +"Driver : John" ;
			contentString2=" Car 2: Going from "+ start +" to " + end + "<br />" +"Driver : Ryan" ;
			var infowindow1 = new google.maps.InfoWindow({
			content: contentString1
			});
			var infowindow2 = new google.maps.InfoWindow({
			content: contentString2
			});



google.maps.event.addListener(marker3, 'click', function() {
  infowindow1.open(map,marker3);
});
google.maps.event.addListener(marker4, 'click', function() {
  infowindow2.open(map,marker4);
});
		  
		  
		 

        directionsService.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
          }
        });
      }
    function doNothing() {}

    
  </script>
  </head>
  <body style="margin:0px; padding:0px;" onload="load()"> 
    <div>
    <input type="text" id="start" />
	<input type="text" id="end" />
    <select id="radiusSelect">
      <option value="5" selected>5mi</option>
      <option value="10">10mi</option>
      <option value="15">15mi</option>
    </select>
    <input type="button" onclick="calcRoute()" value="Calculate Route"/>
    <input type="button" onclick="searchLocations()" value="Search"/>

    </div>
    <div><select id="locationSelect" style="width:100%;visibility:hidden"></select></div>
    <div id="map" style="width: 100%; height: 80%"></div>
  </body>
</html>
