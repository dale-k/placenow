/*

    put these 2 line into ur file ,  map will show in the div section
        
        <div id="map"></div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIgTQnz-ogU8mW_AidCUlYomtlrCDxUGQ&libraries=places&callback=initMap" async defer></script>

  */
  
  var map;
  var infowindow;

window.initMap = function(){
    
    // initialize map
    
    map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 15
        });
    infowindow = new google.maps.InfoWindow();
    
    // get User Current Location and Search the store near by
    
    // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude
                };
               
            	
    			map.setCenter(pos);
    			var userloc = new google.maps.LatLng(pos);
    			var Usermarker = new google.maps.Marker({
				    position: userloc,
				    map: map,
				    label: "U"
				  });
    			Usermarker.setMap(map);

                // Start search the place near by User Location
                var service = new google.maps.places.PlacesService(map);
                service.nearbySearch({
                    location : pos,
                    radius : 500,
                    type:['store']
                    }, callback);
              
                

              }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
         });
     } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
        
    
    // callback function for the server.nearbySearch
    function callback(results, status) {
    	
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            // here  We can do something to store the results
            createMarker(results[i]);
          }
        }
      }
      
    // createMarker for callback function
      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });
       
        google.maps.event.addListener(marker, 'click', function() {
          // add list to main page
          var placeName = document.createElement('li');
          placeName.innerHTML = place.name;
          document.getElementById('map_list').appendChild(placeName);


          // google map marker
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
    
      }
    
}


  
