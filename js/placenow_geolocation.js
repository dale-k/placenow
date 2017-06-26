
//var checkmsg = setInterval(function(){chatUpdate(0)},2000);
$( document ).ready(function() {
  	//scrolltoBottom();
});
var UserInfo ={
	lat:'',
	lng:'',
	city:'',
	location:'',
	list:[],
	distance:[],
	placeID:[],
	type:''
}
var placeInfo ={
	lat:'',
	lng:'',
	plce_id:''
}

var NearbyPlaceList=document.createElement('div');

function getUserCity(type){
	UserInfo.type = type;
    if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(storeCity);
    } else {

        	console.log("Geolocation is not supported by this browser.");
    }
} // Go to storeCity


function storeCity(position){
	UserInfo.lat = position.coords.latitude;
	UserInfo.lng = position.coords.longitude;
	
	var key_lat = UserInfo.type+'_lat';
	var key_lng = UserInfo.type+'_lng';
	var key_city = UserInfo.type+'_city';


    SessionStore(key_lat,UserInfo.lat);
    SessionStore(key_lng,UserInfo.lng);
    //console.log(localStorage.getItem(key_city));
    if(SessionRetrive(key_city)==null){
    	// no city value in session
    	//alert('try update city');
    	googleCity();

    }else{
    	// city is in session
    	if(ReloadGeolocation(key_lat,key_lng,key_city,UserInfo.lat,UserInfo.lng,200)){
    		// distance short , load from session
    		if(UserInfo.type=='login')storeSessionOutput(); // add session value to form
    		if(UserInfo.type=='chat') htmlCityOutput("result","chat");
    	}else{
    		// distance long , requery again
    		//console.log('try update city');
    		googleCity();
    	}


    }
	
} // Go to googleCity  depends on Session


function googleCity(){
	
	var geocoder;
	geocoder = new google.maps.Geocoder();
	latlng = new google.maps.LatLng(UserInfo.lat, UserInfo.lng);
	geocoder.geocode(
	  {'latLng': latlng}, 
	  function(results, status) {
	      if (status == google.maps.GeocoderStatus.OK) {
	              if (results[2]) {

                      var count = results[2].address_components.length;
					  for(var i = 0; i < count ; i++){
					  	if(results[2].address_components[i].types.includes('locality')){
					  		
					  		UserInfo.city = results[2].address_components[i].long_name;
							SessionStore(UserInfo.type+"_city",UserInfo.city);
							if(UserInfo.type=='chat'){
								var lat = UserInfo.lat;
								var lng = UserInfo.lng;
								var user_city = UserInfo.city;
								var action ='chat';
								AjaxStorePosition(lat,lng,user_city,action);
							}else{
								htmlCityOutput(results,UserInfo.type);
							}
					  	}
					  	if(results[2].address_components[i].types.includes('country')){
					  		// for country
					  	}

					  	if(results[2].address_components[i].types.includes('administrative_area_level_1')){
					  		// for state
					  	}

					  }
                      
	                  	                 

	              }
	              else  {
	                  console.log("Can't found City.");
	              }
	      }
	       else {
	          console.log("Geocoder failed due to: " + status);
	      }
	});

	
}  // User function htmlCityOutput to output 



function getUserLocation(){

	if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(storeLocation);
    } else {

        	console.log("Geolocation is not supported by this browser.");
    }

}
function storeLocation(position){
	UserInfo.lat = position.coords.latitude;
	UserInfo.lng = position.coords.longitude;

	googlePlaces();

}

function googlePlaces(){
	
	var pos = {
                  lat: UserInfo.lat,
                  lng: UserInfo.lng
              };
    var request = {
    location: new google.maps.LatLng(pos),
    radius: 500,
    types: ['all','store']
	};

	var service = new google.maps.places.PlacesService(NearbyPlaceList);
	service.nearbySearch(request, function (results, status) {

	    if (status == google.maps.places.PlacesServiceStatus.OK) {

	        for (var i = 0; i < results.length; i++) {

	            UserInfo.list[i] = results[i].name ;
	            placeInfo.lat = results[i].geometry.location.lat();
	            placeInfo.lng = results[i].geometry.location.lng();
	            UserInfo.placeID[i]=results[i].place_id;
	           // console.log(results[i].geometry);
	           // console.log(results[i].geometry.location.lat()+"  ,  "+results[i].geometry.location.lng());
	            UserInfo.distance[i]=distance(UserInfo.lat,UserInfo.lng,placeInfo.lat,placeInfo.lng);
	          //  console.log(UserInfo.list[i]+"   dis :  "+UserInfo.placeID[i]);
	        }

	      //console.log(JSON.stringify(results));
	    }
		
	    // put the place list in Your location
		for(var i = 0 ; i < UserInfo.list.length;i++){
		// console.log('go!');
			if(UserInfo.distance[i]<500){
			

			}
		}


	});
	
	google_placesearch= 1 ;
}

// find distance between 2 GPS point
function distance(lon1, lat1, lon2, lat2) {
  var R = 6371; // Radius of the earth in km
  var dLat = (lat2-lat1).toRad();  // Javascript functions in radians
  var dLon = (lon2-lon1).toRad();
   
  var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
          Math.cos(lat1.toRad()) * Math.cos(lat2.toRad()) * 
          Math.sin(dLon/2) * Math.sin(dLon/2);
   
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a))*1000;
   
  var d = R * c; // Distance in m
  
  return d;
}
/** Converts numeric degrees to radians */
if (typeof(Number.prototype.toRad) === "undefined") {
  Number.prototype.toRad = function() {
    return this * Math.PI / 180;
  }
}

function diffDatetime(timestamp){
	var one_day=86400;
	var one_week = one_day*7;
	var one_month = one_day*30;
	var date = new Date(timestamp);
	console.log(date);
	var millisecond = date.getTime();
	var now = Date.now();
	console.log(now+ "data timezone : "+date.getTimezoneOffset());
	var timezone = date.getTimezoneOffset();
	now +=timezone*60*1000;
	
	var diff =Math.floor(( now - millisecond )/1000);
	console.log("diff : "+diff);
	var diff_result ="";
	if ( diff > one_day ){
		if(diff>=one_day&&diff<one_week){
			var Dayago = Math.floor(diff/one_day)+ " day ago";
			diff_result = Dayago;
		}else if(diff>=one_week&&diff<one_month){
			var Weekago = Math.floor(diff/one_week)+" week and";
			var dayleft = Math.floor((diff%one_week)/one_day)+" day ago";
			diff_result = Weekago +dayleft;
		}else if(diff>=one_month&&diff<(one_month*3)){
			var Monthago = Math.floor(diff/one_month)+" month ago";
			diff_result = Monthago;
		}else{
			var month = (date.getMonth()+1).toString();
			if (month.length < 2) month = "0"+month;
			var day = date.getDate().toString();
			if (day.length < 2) day = "0"+day;
			var year = date.getFullYear().toString().substr(2);
	        diff_result =month+"-"+day+"-"+year;
		}
		
    }else{
        if ( diff < 60 ){
            diff_result = diff+'s ago';
        }
        else if ( diff > 60 && diff < 3600 )
            diff_result = Math.floor( diff/60 )+'m ago';
        else if ( diff > 3600 ){
            diff_result = Math.floor( diff/3600 )+'h ago';
        }else{}
    }

    return diff_result;
}


// "formatted_address" : "277 Bedford Avenue, Brooklyn, NY 11211, USA",
// "formatted_address" : "Grand St/Bedford Av, Brooklyn, NY 11211, USA",
// "formatted_address" : "Grand St/Bedford Av, Brooklyn, NY 11249, USA",
// "formatted_address" : "Bedford Av/Grand St, Brooklyn, NY 11211, USA",
// "formatted_address" : "Brooklyn, NY 11211, USA",
// "formatted_address" : "Williamsburg, Brooklyn, NY, USA",
// "formatted_address" : "Brooklyn, NY, USA",
// "formatted_address" : "New York, NY, USA",
// "formatted_address" : "New York, USA",
// "formatted_address" : "United States",
// console.log(','+results[5].address_components[0].long_name+',');
// console.log(','+results[5].address_components[1].long_name+',');
// console.log(','+results[5].address_components[2].long_name+',');
// console.log(','+results[5].address_components[3].long_name+',');
// console.log(','+results[5].address_components[4].long_name+',');