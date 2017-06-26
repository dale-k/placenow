
@extends('layouts.master')

@section('title','Whats Happening - Chat - Public')

@section('style')
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top_modified.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/chat.css') }}">
<style>
.location-list-container{
	margin-top:20px;
}
.place-list{
	padding:5px;
	font-size: 16px;
	list-style: none;
	border:1px solid grey;
	border-radius: 5px;
	text-align: center;
}
.place-list a{
	text-decoration: none;
	width:inherit;
	margin:0 auto;
}

</style>
@endsection


@section('content')

@include('layouts.top_new')
@include('layouts.chat_navbar2')
<div class="container">
	<div class="location-list-container row">

		<ul class="lists" id="list-container">



		</ul>
	</div>


</div>

<meta name="_token" content="{!! csrf_token() !!}" />
@endsection

@section('replace-geolocation')

<script src="{{ URL::asset('js/chat.js') }}"></script>

@overwrite

@section('script')
<script type="text/javascript">
$(document).ready(function(){

	getUserLocation('load-location');

});

function getUrl(){
	pathArray = location.href.split( '/' );
	protocol = pathArray[0];
	host = pathArray[2];

	return  protocol + '//' + host;
}

function userLocationHtmlOutput(results){
	//alert('place list loaded');
	pathArray = location.href.split( '/' );
	protocol = pathArray[0];
	host = pathArray[2];
	
	var list_container =  document.getElementById('list-container');
	for (var i = 0; i < results.length; i++) {

	            
				var str = results[i].name;
				var new_str = str.replace(/ /g,"_");

	            UserInfo.list[i] = new_str;
	            placeInfo.lat = results[i].geometry.location.lat();
	            placeInfo.lng = results[i].geometry.location.lng();
	            UserInfo.placeID[i]=results[i].place_id;
	            UserInfo.distance[i]=distance(UserInfo.lat,UserInfo.lng,placeInfo.lat,placeInfo.lng);

	            
	            var list = document.createElement('li');
	            list.setAttribute('class','place-list col-md-6 col-md-offset-3');
	            list.innerHTML="<a href='#' onclick=placeClicked(\""+UserInfo.list[i]+"\",\""+UserInfo.placeID[i]+"\");>" + UserInfo.list[i] +"</a>";
	            list_container.appendChild(list);
	            
	        }

}


function placeClicked(location_picked,place_id) {
	console.log(" Location :"+ location_picked+", id :"+place_id+"||");
	var id = place_id;
	url = getUrl();
	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

	$.ajax({
		type:'POST',
		data:{
			place_name:location_picked,
			gplace_id:place_id
		},
		url:'/placenow/chat/findroom',
		success:function(response){
		
			// console.log(response);
			return window.location.href = url+'/placenow/chat/place/'+place_id;
		}// end of success ajax

		
		//end of ajax
	}).done(function() {

		

		});
		
}

</script>

@endsection

