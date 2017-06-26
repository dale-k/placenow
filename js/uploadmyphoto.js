
var formInput = {
    pubOrPri:'public',
    selectTextOnly:'',
		lat:'',
		lng:'',
		list:[],
		selectedPlace:'',
		noplace:{
			bool:false,
			name:'',
			report:''
		},
    lat_list:[],
    lng_list:[],
    place_lat:'',
    place_lng:'',
    gplace_id:'',
    city:'',
    state:'',
    country:'',
		pic_loc:'',
    complete:''
	}
$(document).ready(function(){

  askIfUserWantsTextOnly();

  var userLoc = 'not confirmed';
  // Check if users location has been confirmed.
  if (userLoc != 'not confirmed'){
  	// Then load post picture theme
  }
  else // if not confirm questions
  {

  	// First - ask user the place
  	// This will change the panel title
  	//document.getElementById('panelTitle').innerHTML = 'Where are you?';

  }

  var ump_step_obj = {
  	firstStep:"Select where you are.",
  	secondStep:"",
  	thirdStep:""
  };

  var user_select = {
  	firstSelect:""
  }

  $('#dk-mobile-menu-opener').on('click', function (e) {
    if ( document.getElementById('dk-mobile-menu-list').style.display == 'block' ){
      $('#dk-mobile-menu-list').show();
    }else{
      $('#dk-mobile-menu-list').hide();
    }
  });

});
// $(document).change(function(){
//   if($('#imgThumbnail').html() != ''){
//     alert();
//   }
// });


 
//   $('#imgThumbnail').trigger("contentchanged");
//   $('#imgThumbnail').bind('contentchanged',function(){
//       alert('thumbnail changed');
//       var input = document.getElementById('imageFile');
//       getOrientation(input.files[0], function(orientation) {
//       alert('orientation: ' + orientation);
//       if(orientation==6){
//         //right turn 90
//         rotateImg();
//       }else if(orientation==8){

//       }else{

//       }
//     });
//   });









var map;
var infowindow;
//window.initMap = function(){
function initMap(){
    getListForm();
    document.getElementById('progressBar').style.display = "block";
    document.getElementById('progressBar').style.width = "30%";
    
    
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

                formInput.lat = pos.lat;
                formInput.lng = pos.lng;
               // check city , state , country
            	   var geocoder;
                  geocoder = new google.maps.Geocoder();
                  latlng = new google.maps.LatLng(formInput.lat, formInput.lng);
                  geocoder.geocode(
                      {'latLng': latlng}, 
                      function(results, status) {
                          if (status == google.maps.GeocoderStatus.OK) {
                                  if (results[2]) {

                                    var count = results[2].address_components.length;
                     
                                    for(var i = 0; i < count ; i++){
                                      if(results[2].address_components[i].types.includes('locality')){
                                        formInput.city = results[2].address_components[i].long_name;
                                      }
                                      if(results[2].address_components[i].types.includes('country')){
                                        // for country
                                        formInput.country = results[2].address_components[i].long_name;
                                      }

                                      if(results[2].address_components[i].types.includes('administrative_area_level_1')){
                                        // for state
                                        formInput.state = results[2].address_components[i].long_name;
                                      }

                                    }
                                            htmlCityOutput(results,UserInfo.type);                   

                                    }else  {
                                      alert("address not found");
                                  }
                          }
                           else {
                              alert("Geocoder failed due to: " + status);
                          }
                  }); 
               //
    			map.setCenter(pos);
    			var userloc = new google.maps.LatLng(pos);
    			var Usermarker = new google.maps.Marker({
				    position: userloc,
				    map: map,
				    label: "U"
				  });
    			Usermarker.setMap(map);

          document.getElementById('progressBar').style.width = "100%";


          var types = ['airport','amusement_park','aquarium','art_gallery','atm','bakery','bank',
                     'bar','beauty_salon','bicycle_store','book_store','bowling_alley','bus_station','cafe','campground',
                     'car_dealer','car_rental','car_repair','car_wash','casino','cemetery','church','city_hall','clothing_store',
                     'convenience_store','courthouse','dentist','department_store','electronics_store','embassy','fire_station',
                     'florist','food','funeral_home','furniture_store','gas_station','general_contractor','grocery_or_supermarket',
                     'gym','hair_care','hardware_store','home_goods_store','hospital','insurance_agency','jewelry_store',
                     'laundry','library','liquor_store','local_government_office','lodging','movie_theater','museum','night_club',
                     'park','parking','pet_store','pharmacy','police','post_office','restaurant','rv_park','school','shoe_store',
                     'shoppting_mall','spa','stadium','storage','store','subway_station','taxi_stand','train_station','transit_station',
                     'university','veterinary_care','zoo','establishment'];

          //Start search the place near by User Location
          var service = new google.maps.places.PlacesService(map);
          // service.nearbySearch({
          //     location : pos,
          //     radius : 250,
          //     //type:['all'],
          //     //rankBy:google.maps.places.RankBy.PROMINENCE,
          //     // rankBy: google.maps.places.RankBy.DISTANCE,
          //     types:types
          //     }, callback);


          var request = {
            location : pos,
            radius : 50,
            //types: types
            type:'all'
          };
          service.radarSearch(request, callback);    
                

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
          document.getElementById('progressBar_wrap').style.display = "none";
         
          for (var i = 0; i < results.length; i++) {


            var service = new google.maps.places.PlacesService(map);
            service.getDetails(results[i], function(result, status) {
              if (status !== google.maps.places.PlacesServiceStatus.OK) {
                console.error(status);
                return;
              }
              formInput.list[i] = result.name;
              formInput.lat_list[i]=result.geometry.location.lat();
              formInput.lng_list[i]=result.geometry.location.lng();
              formInput.gplace_id = result.place_id;
              createMarker(result.name,result.geometry.location.lat(),result.geometry.location.lng(),formInput.lat,formInput.lng);
            });


            // here  We can do something to store the results
            // formInput.list[i] = results[i].name;
            // formInput.lat_list[i]=results[i].geometry.location.lat();
            // formInput.lng_list[i]=results[i].geometry.location.lng();
            // formInput.gplace_id = results[i].place_id;
            // createMarker(results[i].name,results[i].geometry.location.lat(),results[i].geometry.location.lng(),formInput.lat,formInput.lng);
          
          }

         
             
        }
      }
      
    // createMarker for callback function
      function createMarker(place,lat,lng,picture_lat,picture_lng) {
        // add list to main page
          var placeName = document.createElement('li');
          var place_lat = document.createElement('input');
          var place_lng = document.createElement('input');
          place_lat.setAttribute('type', 'hidden');
          place_lng.setAttribute('type', 'hidden');
          place_lat.setAttribute('value', lat);
          place_lng.setAttribute('value', lng);
          var picture_lat = document.createElement('input');
              picture_lat.setAttribute('type', 'hidden');
              picture_lat.setAttribute('value',formInput.lat);
              picture_lat.setAttribute('id',"picture_lat");
          var picture_lng = document.createElement('input');
              picture_lng.setAttribute('type', 'hidden');
              picture_lng.setAttribute('value',formInput.lng);
              picture_lng.setAttribute('id','piture_lng');
          var picture_gplace_id = document.createElement('input');
              picture_gplace_id.setAttribute('type', 'hidden');
              picture_gplace_id.setAttribute('value',formInput.gplace_id);
              picture_gplace_id.setAttribute('id','piture_gplace_id');
          placeName.className = 'list-group-item';
          placeName.id = 'generated_list';
          placeName.innerHTML = place;
          document.getElementById('listGroup').appendChild(placeName);
          document.getElementById('listGroup').appendChild(place_lat);
          document.getElementById('listGroup').appendChild(place_lng);
          document.getElementById('listGroup').appendChild(picture_lat);
          document.getElementById('listGroup').appendChild(picture_lng);
          document.getElementById('listGroup').appendChild(picture_gplace_id);

          placeName.onclick = function(event){
          	// 
          	var thisList = event.target;
            var lat = thisList.nextSibling;
            var lng = lat.nextSibling;
            var pic_lat = lng.nextSibling;
            var pic_lng = pic_lat.nextSibling;
            var gplace_id = pic_lng.nextSibling;
          	window.selectedPlace = thisList.innerHTML;
          	formInput.selectedPlace = window.selectedPlace;
            formInput.place_lat = lat.value;
            formInput.place_lng = lng.value;
            formInput.lat = pic_lat.value;
            formInput.lng = pic_lng.value;
            formInput.gplace_id = gplace_id.value;

         //   formInput.lat = document.getElementById('picture_lat').value();
         //   formInput.lng = document.getElementById('picture_lng').value();
          	document.getElementById('selected-place').innerHTML = '  @ ' + window.selectedPlace + '';//'Post My Photo <br><small>  @ ' + window.selectedPlace + '</small>';
          	document.getElementById('panelTitle').innerHTML = 'Select Your Picture.';
          	showUploadPhoto(formInput.selectedPlace);

          //  console.log(JSON.stringify(formInput));
          	//storeToSession('location',this.textContent); 

          };
      }
    
}



function privateOrpublic(){
  document.getElementById('panelBody-2').style.display = 'none';
  document.getElementById('refresh-list').style.display = 'none';

  var print = '<li class="list-group-item" onclick="selectPriorPub(\'private\');">'+
                'Private'+
              '</li>'+
              '<li class="list-group-item" onclick="selectPriorPub(\'public\');">'+
                'Public'+
              '</li>';

  document.getElementById('panelTitle').innerHTML = 'Would you share your post?';
  document.getElementById('panelBody-1').innerHTML = print;
  document.getElementById('panelBody-1').style.display = 'block';
}

function selectPriorPub(select){
  if (select == 'private'){
    formInput.pubOrPri = 'private';
    $('#public-btn').removeClass('selected');
    $('#private-btn').addClass('selected');
  }else if (select == 'public'){
    formInput.pubOrPri = 'public';
    $('#public-btn').addClass('selected');
    $('#private-btn').removeClass('selected');
  }

  //askIfUserWantsTextOnly()
}

function askIfUserWantsTextOnly(){

  document.getElementById('panelBody-2').style.display = 'none';
  document.getElementById('refresh-list').style.display = 'none';

  var print = '<li class="list-group-item" onclick="selectTextOnly(\'photo\');">'+
                'Share Photo'+
              '</li>'+
              '<li class="list-group-item" onclick="selectTextOnly(\'text\');">'+
                'Text Only'+
              '</li>';

  document.getElementById('panelTitle').innerHTML = 'Would you share your post?';
  document.getElementById('panelBody-1').innerHTML = print;
  document.getElementById('panelBody-1').style.display = 'block';
}

function selectTextOnly(select){

  if (select == 'photo'){
    formInput.selectTextOnly = 'photo';
  }else if (select == 'text'){
    formInput.selectTextOnly = 'text';
  }

  $('#refresh-list').show();
  document.getElementById('panelTitle').innerHTML = 'Where are you?';
  document.getElementById('panelBody-1').style.display = 'none';
  document.getElementById('panelBody-2').style.display = 'block';
}

function getListForm(){
  var print = '<div class="progress" id="progressBar_wrap">'+
              '<div class="progress-bar progress-bar-striped active" id="progressBar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">'+
                '<span class="sr-only">45% Complete</span>'+
              '</div>'+
            '</div>'+
            '<ul class="list-group" id="listGroup"></ul>'+
            '<button type="button" class="btn btn-danger active" onclick="youcantfind();">You can\'t find ?</button>'+
            '<button type="button" class="btn btn-default" onclick="cancelPost();">Cancel</button>';

  if (formInput.selectTextOnly != ''){
    $('#refresh-list').show();
  }
  document.getElementById('panelBody-2').innerHTML = print;
} 
function prevStep(){
  if ( formInput.selectedPlace == '' && formInput.noplace.bool == false && formInput.selectTextOnly == '' ){
    // Just take user to home
    cancelPost();
  }else if ( formInput.selectedPlace == '' && formInput.noplace.bool == false && formInput.selectTextOnly != '' ){
    $('#refresh-list').hide();
    formInput.selectTextOnly = '';
    askIfUserWantsTextOnly();
  }else if ( formInput.selectedPlace != '' && formInput.noplace.name == '' ){
    // User already selected place from the list
    // Take user back to place list
    formInput.selectedPlace = ''; // reset
    $('#selected-place').html(''); // reset
    //$('#refresh-list').show();
    getListForm();
    initMap();
  }else if ( formInput.selectedPlace != '' && formInput.noplace.name != '' ){
    // User entered name of the place
    // Back to enter the place
    formInput.selectedPlace = '';
    formInput.noplace.bool = false;
    formInput.noplace.name = '';
    youcantfind();
  }else if ( formInput.noplace.bool == true && formInput.noplace.name == '' ){
    // Back to the place list
    formInput.noplace.bool = false;
    //$('#refresh-list').show();
    getListForm();
    initMap();
  }else if ( formInput.noplace.bool == true && formInput.noplace.name != '' ){
    // Back to the place list
    formInput.noplace.name = '';
    //$('#refresh-list').show();
    getListForm();
    initMap();
  }

}

function youcantfind(){
  $('#refresh-list').hide();
	formInput.noplace.bool = true;
	//document.getElementById('pageHeader1').innerHTML = 'Post My Photo';
    document.getElementById('panelTitle').innerHTML = 'Enter your place.';
    var panelBody_html =  '<div class="form-group">'+
                          '<input name="new_loc" class="form-control" type="text" id="new_loc" value=""/>' +
    					  '<button type="button" class="btn btn-primary btn-lg active" onclick="newLocEntered();">OK</button>'+
                '<button type="button" class="btn btn-default btn-lg active" onclick="cancelPost();">Cancel</button>'+ 
                '</div>';
    document.getElementById('panelBody').innerHTML = panelBody_html;
}

function cancelPost(){

  var url = window.location.href;
  url = url.replace('postmyphoto','');
  window.location.href = url;

}

function newLocEntered(){
	var input = document.getElementById('new_loc').value;

	if ( input.replace(/ /g,'') != "" ){

		var trimInput = input.toLowerCase().replace(/ /g,'');

		var matched = 'no';
		for(var i = 0; i < formInput.list.length; i++){
			if ( formInput.list[i].toLowerCase().replace(/ /g,'') == input.toLowerCase().replace(/ /g,'') ){


				// we found macthed name 
				matched = 'yes';

				formInput.noplace.report = "user's input matched the list.";

				formInput.noplace.name = formInput.list[i];
				formInput.selectedPlace = formInput.list[i];

				// end for loop
				i = formInput.list.length;


			}
		}

		if ( matched == 'no' ){
			formInput.noplace.name = input;
			formInput.selectedPlace = input;
		}


		showUploadPhoto(formInput.selectedPlace);

	}
	else {



	}

	

}

function showUploadPhoto(place){

  $('#refresh-list').hide();

  var panelBody_html =  '<div class="row">'+
                          '<form id="lastForm" enctype="multipart/form-data">';

  document.getElementById('selected-place').innerHTML = ' @ ' + place + '';//'Post My Photo <br> <small>  @ ' + place + '</small>';

  if (formInput.selectTextOnly == 'photo'){
    document.getElementById('panelTitle').innerHTML = 'Select Your Picture.';

    panelBody_html += '' +
        '<div class="col-md-12">'+
          '<div class="fileinput fileinput-new" data-provides="fileinput" style="width:100%;">' + 
            '<div id="imgThumbnail" class="fileinput-preview thumbnail" onclick="triggerFileInput();" data-trigger="fileinput" style="width: 100%; height: 200px;">'+
              '<div style="width:100%; height:100%; line-height:200px;">'+
                '<span class="glyphicon glyphicon-camera camera-icon" aria-hidden="true"></span>'+
              '</div>'+
            '</div>' +
            '<div style="display:none;">' +
              '<span class="btn btn-default btn-file">'+
              '<span class="fileinput-new">Select image</span>'+
              '<span class="fileinput-exists">Change</span>'+
              '<input type="file" name="picloc" id="imageFile" accept="image/*;capture=camera" onchange="getNewImageFile();"></span>'+
              '<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>'+
              '<button type="button" class="btn btn-default fileinput-exists rotate-img-btn" onclick="rotateImg();"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>'+
            '</div>'+
          '</div>'+
        '</div>';
  }else {
    document.getElementById('panelTitle').innerHTML = 'Share What\'s Happening!';
  }
          	

  panelBody_html += ''+
        '<div class="col-md-12 wrap-public-private-btn">'+
        '<button type="button" class="btn btn-default public-btn selected" id="public-btn" onclick="selectPriorPub(\'public\');">Public</button>'+
        '<button type="button" class="btn btn-default private-btn" id="private-btn" onclick="selectPriorPub(\'private\');">Private</button>'+
        '</div>'+
        ''+
        '<div class="col-md-12">'+
          '<input type="text" id="title" class="form-control" style="margin-bottom:5px;" placeholder="Type the title" >'+
          '<input type="text" id="tags" class="form-control" onKeyUp="tagKeyup();" style="margin-bottom:5px;" placeholder="Type your own tags, Using # , seperate by one white space" >'+
          '<textarea id="comment" class="form-control" style="margin-bottom:3px;" rows="5" col="30" placeholder="Leave your comment here."></textarea>'+
          '<button type="button" class="btn btn-primary submit-btn" style="margin-right:3px;" onClick="submitPicture();">Submit</button>'+
          '<button type="button" class="btn btn-default close-btn" onclick="cancelPost();">Cancel</button>'+
        '</div>'+
      '</form>'+
    '</div>';



  document.getElementById('panelBody-2').innerHTML = panelBody_html;
}

function triggerFileInput(){
  $('#imageFile').click();
}

function getNewImageFile(){
  if(document.getElementById("imageFile").value != "") {
     // you have a file
     var input = document.getElementById('imageFile');
     var imageFile = input.files[0];

     document.getElementById('imgThumbnail').innerHTML = '<img class="" alt="Responsive image" src="' + URL.createObjectURL(imageFile) + '">';
     document.getElementById('imgThumbnail').firstChild.style.display = 'none';

     getOrientation(imageFile, function(orientation) {
     
      if(orientation == 6){
       //right turn 90
        rotateImg();
      }else if(orientation==8){

      }else{

      }
      document.getElementById('imgThumbnail').firstChild.onload = function(){
        document.getElementById('imgThumbnail').firstChild.style.display = 'block';
      };

    });
  }
}

function getOrientation(file, callback) {
  var reader = new FileReader();
  reader.onload = function(e) {

    var view = new DataView(e.target.result);
    if (view.getUint16(0, false) != 0xFFD8) return callback(-2);
    var length = view.byteLength, offset = 2;
    while (offset < length) {
      var marker = view.getUint16(offset, false);
      offset += 2;
      if (marker == 0xFFE1) {
        if (view.getUint32(offset += 2, false) != 0x45786966) return callback(-1);
        var little = view.getUint16(offset += 6, false) == 0x4949;
        offset += view.getUint32(offset + 4, little);
        var tags = view.getUint16(offset, little);
        offset += 2;
        for (var i = 0; i < tags; i++)
          if (view.getUint16(offset + (i * 12), little) == 0x0112)
            return callback(view.getUint16(offset + (i * 12) + 8, little));
      }
      else if ((marker & 0xFF00) != 0xFF00) break;
      else offset += view.getUint16(offset, false);
    }
    return callback(-1);
  };
  reader.readAsArrayBuffer(file.slice(0, 64 * 1024));
}

var deg = 0;
function rotateImg(){
  var thumbnail = document.getElementById('imgThumbnail');
  
   if( thumbnail.innerHTML != '' ){
    deg = deg + 90;
    var div = thumbnail.firstChild;
    
    div.style.webkitTransform = 'rotate('+deg+'deg)'; 
    div.style.mozTransform    = 'rotate('+deg+'deg)'; 
    div.style.msTransform     = 'rotate('+deg+'deg)'; 
    div.style.oTransform      = 'rotate('+deg+'deg)'; 
    div.style.transform       = 'rotate('+deg+'deg)'; 

   }
}

function tagKeyup(){
  //alert($('#tags').val());
  var input = $('#tags').val();
  var length = input.length;

  //alert(input.indexOf(' '));

  if (length == 1 && input.charAt(0) != '#'){
    input = '#'+input;
    $('#tags').val(input);
  }else if ( length > 2 && input.charAt(length-2) == ' ' && input.charAt(length-1) !=' ' ){
    input = input.substr(0, length-2) + '-' + input.charAt(length-1);
    $('#tags').val(input);
  }else if ( length > 2 && input.charAt(length-3) != '#' && input.charAt(length-2) == ' ' && input.charAt(length-1) == ' ' ){
    input = input.substr(0, length-2) + '#';
    $('#tags').val(input);
  }else{
    if (input.charAt(0) != '#'){
      $('#tags').val('#' + input);
    }else if ( input.charAt(input.indexOf(' ')) && input.charAt(input.indexOf(' ')-1) != '-' && input.charAt(input.indexOf(' ')-1) != '#' ){
      var whitespace_index = input.indexOf(' ');
      //alert(whitespace_index);
      input = input.substr(0,whitespace_index) + '-' + input.substr(whitespace_index+1,input.length-1);
      //alert(input);
      $('#tags').val(input);
    }else if ( input.charAt(input.indexOf(' ')) && input.charAt(input.indexOf(' ')-1) == '-' ){
      var whitespace_index = input.indexOf(' ');
      input = input.substr(0,whitespace_index-1) + '#';
      //alert(input);
      $('#tags').val(input);
    }else if ( input.charAt(input.indexOf(' ')) && input.charAt(input.indexOf(' ')-1) == '#' ){
      var whitespace_index = input.indexOf(' ');
      input = input.substr(0,whitespace_index);
      //alert(input);
      $('#tags').val(input);
    }
  }
}

window.submitPicture = function (){
  // Validate Input
 if ( !$('#imageFile').val()  && formInput.selectTextOnly == 'photo' ) {
  alert('Image is not selected!');
  return ;
 }

  method = 'post'; // Set method to post by default if not specified.
  path = '/placenow/postmyphoto';

  var form = document.getElementById('lastForm');
  form.setAttribute('method', method);
  form.setAttribute('action', path);

  var privateOrPublic = document.createElement('input');
  privateOrPublic.setAttribute('type', 'hidden');
  privateOrPublic.setAttribute('value',formInput.pubOrPri);
  privateOrPublic.setAttribute('name',"privateOrPublic");
  form.appendChild(privateOrPublic);

  var selectTextOnly = document.createElement('input');
  selectTextOnly.setAttribute('type', 'hidden');
  selectTextOnly.setAttribute('value',formInput.selectTextOnly);
  selectTextOnly.setAttribute('name',"selectTextOnly");
  form.appendChild(selectTextOnly);

  var picture_lat = document.createElement('input');
  picture_lat.setAttribute('type', 'hidden');
  picture_lat.setAttribute('value',formInput.lat);
  picture_lat.setAttribute('name',"picture_lat");
  form.appendChild(picture_lat);

  var picture_lng = document.createElement('input');
  picture_lng.setAttribute('type', 'hidden');
  picture_lng.setAttribute('value',formInput.lng);
  picture_lng.setAttribute('name','picture_lng');
  form.appendChild(picture_lng);

  var place_lat = document.createElement('input');
  place_lat.setAttribute('type', 'hidden');
  place_lat.setAttribute("name", 'place_lat');
  place_lat.setAttribute('value', formInput.place_lat);
  form.appendChild(place_lat);

  var place_lng = document.createElement('input');
  place_lng.setAttribute('type', 'hidden');
  place_lng.setAttribute("name", 'place_lng');
  place_lng.setAttribute('value', formInput.place_lng);
  form.appendChild(place_lng);

  var gplace_id = document.createElement('input');
  gplace_id.setAttribute('type', 'hidden');
  gplace_id.setAttribute("name", 'gplace_id');
  gplace_id.setAttribute('value', formInput.gplace_id);
  form.appendChild(gplace_id);

  var title = document.createElement('input');
  title.setAttribute('type','hidden');
  title.setAttribute('name','title');
  title.setAttribute('value',document.getElementById('title').value);
  form.appendChild(title);

  var tags = document.createElement('input');
  tags.setAttribute('type','hidden');
  tags.setAttribute('name','tags');
  tags.setAttribute('value',document.getElementById('tags').value);
  form.appendChild(tags);

  var comment = document.createElement('input');
  comment.setAttribute('type', 'hidden');
  comment.setAttribute("name", 'comment');
  comment.setAttribute('value', document.getElementById('comment').value);
  form.appendChild(comment);

  var city = document.createElement('input');
  city.setAttribute('type', 'hidden');
  city.setAttribute("name", 'city');
  city.setAttribute('value', formInput.city);
  form.appendChild(city);

  var state = document.createElement('input');
  state.setAttribute('type', 'hidden');
  state.setAttribute("name", 'state');
  state.setAttribute('value', formInput.state);
  form.appendChild(state);

  var country = document.createElement('input');
  country.setAttribute('type', 'hidden');
  country.setAttribute("name", 'country');
  country.setAttribute('value', formInput.country);
  form.appendChild(country);

  var location = document.createElement('input');
  location.setAttribute('type', 'hidden');
  location.setAttribute("name", 'location');
  location.setAttribute('value', formInput.selectedPlace);
  form.appendChild(location);

  var imgDeg = document.createElement('input');
  imgDeg.setAttribute('type', 'hidden');
  imgDeg.setAttribute("name", 'imgDeg');
  imgDeg.setAttribute('value', deg);
  form.appendChild(imgDeg);

  var token = document.createElement('input');
  token.setAttribute('type', 'hidden');
  token.setAttribute("name", '_token');
  token.setAttribute('value', $("#token").attr('content'));
  form.appendChild(token);

  //alert(document.getElementById("imageFile").value);

  form.submit();

  //alert("post sent !");
}