
var consistantUpdate;

function Run(name,related_id,page_type){

	consistantUpdate = setInterval(function(){chatUpdate(name,related_id,page_type)},3000);

}

function Stop(){
	clearInterval(consistantUpdate);
}


$(document).ready(function(){
	 //console.log($(".chat-title a").text());
	
	// scroll the chat message to the bottom line
	if($(".chat-title a").text()!="Location Loading")scrolltoBottom();

	// adjust the report section postions
	$('div.report-section').each(function(){
		var height = $(this).parent().find('.user-msg-detail').height()
		$(this).height(height);
	});

	// for mobile view
	var check_mobile_nav = 0
	$('.mobile-pulldown').click(function(e){
		if(check_mobile_nav==0){

		$('.nav-pills-mobile').show();
			check_mobile_nav =1;
		$(this).insertAfter('.nav-pills-mobile')
		}else{
		$('.nav-pills-mobile').hide();
			check_mobile_nav =0;	
		}
	});



	// submit button clicked
	$('#message_send').click(function(e){
		e.preventDefault();
		console.log("clicked");
		ajaxStoreMessage();
	})

	// press enter to submit message
	$('#message_input').submit(function(e){
		e.preventDefault();
		console.log("entered");
		ajaxStoreMessage();
	})

	// ajax update every 3 second
	var page_type = document.getElementById('type').value;
	var related_id = $('#chatroom_num').val();
	if(page_type=="public"){
		Run("",related_id,page_type);
	}else if(page_type=="city"){
		Run("",related_id,page_type);
	}else if(page_type=="location"){
		Run("",related_id,page_type);
	}else{

	}


});
//var checkmsg = setInterval(function(){chatUpdate(0)},2000);



var UserInfo ={
	lat:'',
	lng:'',
	city:'',
	location:'',
	list:[],
	distance:[],
	placeID:[],
	gplace_id:'',
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
}
function storeCity(position){
	UserInfo.lat = position.coords.latitude;
	UserInfo.lng = position.coords.longitude;
//	console.log(UserInfo.lat+' , '+UserInfo.lng);
	googleCity();
}
var city_searched = 0;
function googleCity(){
	
	var geocoder;
	geocoder = new google.maps.Geocoder();
	latlng = new google.maps.LatLng(UserInfo.lat, UserInfo.lng);
	geocoder.geocode(
	  {'latLng': latlng}, 
	  function(results, status) {
	      if (status == google.maps.GeocoderStatus.OK) {
	              if (results[2]) {
	                  var add= results[2].formatted_address ;
	                  var  value=add.split(",");
	                  count=value.length;
	                  UserInfo.city=value[0].trim();

	                //  console.log(UserInfo.city);
	                $('#tab_city a').text(UserInfo.city);
	               // console.log('loading city chatroom : '+$('#tab_city a').text());
  					chatUpdate($('#tab_city a').text(),$('#tab_city a').text(),'city');
  					var placeID_holder = document.getElementById('chatroom_num');
					placeID_holder.setAttribute('value',UserInfo.city);
	              }
	              else  {
	                  console.log("Can't found City.");
	              }
	      }
	       else {
	          console.log("Geocoder failed due to: " + status);
	      }
	});

	 city_searched = 1;	 
}

var location_searched = 0;
var google_placesearch = 0;

function getUserLocation(type){
	UserInfo.type = type;
	//alert(UserInfo.type);
	if(type !='load-location'){
		if(google_placesearch == 1){
			$('#drop-menu').html('<div class="progress"><div class="progress-bar" id="progress_bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">10%</div></div>');
		}
		
		 var progressbar = document.getElementById('progress_bar');
		 progressbar.style.width="20%";
		 progressbar.innerHTML="20%";
	}


	if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(storeLocation);
    } else {

        	console.log("Geolocation is not supported by this browser.");
    }
}


function storeLocation(position){
	UserInfo.lat = position.coords.latitude;
	UserInfo.lng = position.coords.longitude;

	if(UserInfo.type !='load-location'){
	var progressbar = document.getElementById('progress_bar');
	 progressbar.style.width="30%";
	 progressbar.innerHTML="30%";
	}

	googlePlaces();

}

function googlePlaces(){
	
	var pos = {
                  lat: UserInfo.lat,
                  lng: UserInfo.lng
              };
    var request = {
    location: new google.maps.LatLng(pos),
    radius: 200,
    types: ['airport','amusement_park','aquarium','art_gallery','atm','bakery','bank',
                     'bar','beauty_salon','bicycle_store','book_store','bowling_alley','bus_station','cafe','campground',
                     'car_dealer','car_rental','car_repair','car_wash','casino','cemetery','church','city_hall','clothing_store',
                     'convenience_store','courthouse','dentist','department_store','electronics_store','embassy','fire_station',
                     'florist','food','funeral_home','furniture_store','gas_station','general_contractor','grocery_or_supermarket',
                     'gym','hair_care','hardware_store','home_goods_store','hospital','insurance_agency','jewelry_store',
                     'laundry','library','liquor_store','local_government_office','lodging','movie_theater','museum','night_club',
                     'park','parking','pet_store','pharmacy','police','post_office','restaurant','rv_park','school','shoe_store',
                     'shoppting_mall','spa','stadium','storage','store','subway_station','taxi_stand','train_station','transit_station',
                     'university','veterinary_care','zoo','establishment']
	};
	if(UserInfo.type !='load-location'){
	var progressbar = document.getElementById('progress_bar');
	 progressbar.style.width="80%";
	 progressbar.innerHTML="80%";
	}
	var service = new google.maps.places.PlacesService(NearbyPlaceList);
	service.nearbySearch(request, function (results, status) {

	    if (status == google.maps.places.PlacesServiceStatus.OK) {
			
	    	if(UserInfo.type=='load-location'){

	    		userLocationHtmlOutput(results);

	    		return;
	    	}
	    	
	        for (var i = 0; i < results.length; i++) {

	            UserInfo.list[i] = results[i].name ;
	            placeInfo.lat = results[i].geometry.location.lat();
	            placeInfo.lng = results[i].geometry.location.lng();
	            UserInfo.placeID[i]=results[i].place_id;
	            UserInfo.distance[i]=distance(UserInfo.lat,UserInfo.lng,placeInfo.lat,placeInfo.lng);
	          
	        }

	      //console.log(JSON.stringify(results));
	    }
		    if(UserInfo.type !='load-location'){
			progressbar.style.width="90%";
			progressbar.innerHTML="90%";
			
		    var location_menu = document.getElementById('dropdown-menu');
		     location_menu.innerHTML="<br>";
		    // put the place list in Your location
			for(var i = 0 ; i < UserInfo.list.length;i++){
			// console.log('go!');
				if(UserInfo.distance[i]<500){
				var list = document.createElement('li');
				var place_a = document.createElement('a');
				
				list.setAttribute('id','place_list');

				place_a.setAttribute('href','#location');
				place_a.setAttribute('aria-controls','public');
				place_a.setAttribute('role','tab');
				place_a.setAttribute('data-toggle','tab');
				place_a.innerHTML=UserInfo.list[i];
				var selelocation=UserInfo.list[i];
				var place_id = UserInfo.placeID[i];
				place_a.setAttribute('onclick','placeClicked("'+selelocation+'","'+place_id+'");');


				list.appendChild(place_a);
				location_menu.appendChild(list);

				}
			}
		}

	});
	
	google_placesearch= 1 ;
}

function placeClicked(location_picked,place_id) {
	//  console.log(" Location : "+ location);
	//Stop();
	location_searched = 1;
	$('#drop2').html(location_picked);
	console.log('loading place database :'+place_id);

	var placeID_holder = document.getElementById('chatroom_num');
	placeID_holder.setAttribute('value',place_id);
	var placeID_div = document.getElementById('room_number');
	placeID_div.innerHTML=place_id;

	chatUpdate(location_picked,place_id,'location');
	$('.caret').hide();
	// $('#drop2').attr('data-toggle','tab');
	// $('#drop2').attr('role','tab');
	// $('#drop2').removeClass('dropdown-toggle');
	// $('#dropdown_search').removeClass('dropdown');
	$('#drop-menu').remove();

	$('#tab_public').removeClass('active');
	$('#tab_city').removeClass('active');
	$('#dropdown_search').addClass('active');

	$('#public').removeClass('active');
	$('#city').removeClass('active');
	$('#location').addClass('active');

	$('#location').tab('show');
	//Run(location,place_id,'location');
	scrolltoBottom();
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


function chatUpdate(name,related_id,page_type){
	console.log('Name : '+name+"  ID:  "+related_id+"  ,  page : " +page_type);
	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

	$.ajax({
		type:'POST',
		data:{
			name:name,
			place_id:related_id,
			type:page_type
		},
		url:'/placenow/loadchat',
		success:function(response){
			
			var data = response;
			
			reloadChatmsg(data);

		}// end of success ajax

		
		//end of ajax

	}).done(function() {
		// scroll to bottom after ajax is done

		$('div.report-section').each(function(){
		var height = $(this).parent().find('.user-msg-detail').height()
		$(this).height(height);
		});
		scrolltoBottom();
	});
	

}

function ajaxStoreMessage(){
	console.log('sending message :'+$('#message_input_text').val()+"," +$('#chatroom_num').val()+","+$('#type').val());
	
	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

	$.ajax({
		type:'POST',
		data:{
			message:$('#message_input_text').val(),
			related_id:$('#chatroom_num').val(),
			type:$('#type').val()
		},
		url:'/placenow/chatstore',
		success:function(response){
		
			reloadChatmsg(response);	
			
			$('#message_input_text').val("");

		}// end of success ajax

		
		//end of ajax
	}).done(function() {
		$('div.report-section').each(function(){
		var height = $(this).parent().find('.user-msg-detail').height()
		$(this).height(height);
		});
		scrolltoBottom();
	});
	
	

}


function reloadChatmsg(data){

// <div id="message-line" class="row">
		// <div class="sender-profile-image-wrapper col-md-1 col-xs-1">
		// 	 <img src="{{ url('/img/profile-image.jpg') }}" alt="" class="img-rounded sender-profile-image">
		// </div>
		// <div class="user-msg-detail col-md-10 col-xs-10">
		// 		<div id="message-text" class="col-xs-12 col-md-12">{!!$message -> message!!}</div>
		// 		<div id="message-sender" class="col-xs-4 col-md-1"> &nbsp;by &nbsp;
		// 		<a href="{{url('/user/'.App\User::find($message->user_id)->user)}}">{{App\User::find($message->user_id)->user}}
		// 		</a>
		// 		</div>
		// 		<div id="message-time" class="col-xs-4 col-md-1">				
		// 			<div id="center-time">{{trimCreatedAt($message -> created_at)}}</div>
		// 		</div>
		// 		<div class="report-mobile col-xs-3 visible-xs-block-inline">
		// 			<span class="glyphicon glyphicon-info-sign visible-xs-inline-block"></span>
		// 		</div>
		// </div>
		// <div class="report-section">
		// 	<div>report</div>
		// </div>
	// </div>
	pathArray = location.href.split( '/' );
		protocol = pathArray[0];
		host = pathArray[2];
		url = protocol + '//' + host;

	var id ='message_displayarea';
			var message_update = document.getElementById(id);

			message_update.innerHTML=" ";
		//	console.log('messages length :'+ data.length);
			for(var i = 0; i<data['data_length'];i++){
				
				var chatrow = document.createElement('div');
				chatrow.setAttribute('id','message-line');
				chatrow.setAttribute('class','row');
				
				var profile_imgwrapper = document.createElement('div');
				profile_imgwrapper.setAttribute('class','sender-profile-image-wrapper col-md-1 col-xs-1');

				var profile_img = document.createElement('img');
				profile_img.setAttribute('src',url+'/placenow/img/profile-image.jpg');
				profile_img.setAttribute('class','img-rounded sender-profile-image');

				profile_imgwrapper.appendChild(profile_img);



				var user_msg_detail = document.createElement('div');
				user_msg_detail.setAttribute('class','user-msg-detail col-md-10 col-xs-10');


				var msgsender = document.createElement('div');
				msgsender.setAttribute('id','message-sender');
				msgsender.setAttribute('class','col-xs-1 col-md-1');
				var userlink = document.createElement('a');
				userlink.setAttribute('href',url+'/placenow/user/'+data[i].user.user);
				text =document.createTextNode("    by   ");
				msgsender.appendChild(text);
				text = document.createTextNode(data[i].user.user);
				userlink.appendChild(text);
				msgsender.appendChild(userlink);

				var msgtime = document.createElement('div');
				msgtime.setAttribute('id','message-time');
				msgtime.setAttribute('class','col-xs-1 col-md-1');

				var center_time = document.createElement('div');
				center_time.setAttribute('id','center-time');
				var text = diffDatetime(data[i].created_at);
				var textnode = document.createTextNode(text);
				center_time.appendChild(textnode);
				msgtime.appendChild(center_time);

				var message = document.createElement('div');
				message.setAttribute('id','message-text');
				message.setAttribute('class','col-xs-12 col-md-12');
				message.innerHTML = data[i].message;
				// text = document.createTextNode(data[i].message);
				// message.appendChild(text);

				var report_section = document.createElement('div');
				report_section.setAttribute('class','report-section');

				var report = document.createElement('div');
				text = document.createTextNode('report');
				report.appendChild(text);
				report_section.appendChild(report);
				
				user_msg_detail.appendChild(message);
				user_msg_detail.appendChild(msgsender);
				user_msg_detail.appendChild(msgtime);
				

				chatrow.appendChild(profile_imgwrapper);
				chatrow.appendChild(user_msg_detail);
				chatrow.appendChild(report_section);

				message_update.appendChild(chatrow);
			}// end of loop
}

function diffDatetime(timestamp){
	var one_day=86400;
	var one_week = one_day*7;
	var one_month = one_day*30;
	var date = new Date(timestamp);
	//console.log(date);
	var millisecond = date.getTime();
	var now = Date.now();
//	console.log(now+ "data timezone : "+date.getTimezoneOffset());
	var timezone = date.getTimezoneOffset();
	now +=timezone*60*1000;
	
	var diff =Math.floor(( now - millisecond )/1000);
//	console.log("diff : "+diff);
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

function joinRoom(id){
	// check the number of people in this room
	var type = "POST";
	var url = "/placenow/joinchatrooms"
	var data = {
		chatroom_id:id
	}

	var result = ajaxAction(type,url,data);

	for(var i = 0; i<result.length;i++){
		// display results

	}
}



function scrolltoBottom(){

	$(".message_update").scrollTop($(".message_update")[0].scrollHeight);

}






