
$(document).ready(function(){

	var protocol = window.location.protocol;
	var url_host = window.location.hostname;
	var url_base = 'placenow';

	$('body').on('click', function (e) {
	    //did not click a popover toggle or popover
	    if ($(e.target).data('toggle') !== 'popover' && $(e.target).parents('.popover.in').length === 0) { 
	        $('[data-toggle="popover"]').popover('hide');
	    }
	});

	$('#dk-mobile-menu-opener').on('click', function (e) {
	    $('#dk-mobile-menu-list').toggle();
	});

  $('#search_input').popover({
  	html:true
  });

  $('#search_input').bind('input', function(){

  	$('#search_input').popover('show');

  	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
            }
        })

	$.ajax({
		type:'POST',
		data:{
			search_input:$('#search_input').val()
		},
		url:'/placenow/search',
		success:function(response){
			//alert(response); 	
			var data = response;
			var popover_content = '';
			if (data.city.length == 0 && data.location.length == 0 && data.country.length == 0){
				$('#search_input').attr('data-content', popover_content);
				$('#search_input').popover('hide');
			}else{
				for ( var i = 0; i < data.city.length; i++){
					if(i==0){
						popover_content += '<div class="search-list-title"><b>City</b></div>'
					}
					popover_content += '<div class="search-list-list"><a href="city/'+data.city[i].city+'">'+data.city[i].city+'</a></div>';
				}
				for ( var i = 0; i < data.location.length; i++){
					if(i==0){
						popover_content += '<div class="search-list-title"><b>Place</b></div>'
					}
					popover_content += '<div class="search-list-list"><a href="place/'+data.location[i].location+'">'+data.location[i].location+'</a></div>';
				}
				for ( var i = 0; i < data.country.length; i++){
					if(i==0){
						popover_content += '<div class="search-list-title"><b>Country</b></div>'
					}
					popover_content += '<div class="search-list-list"><a href="country/'+data.country[i].country+'">'+data.country[i].country+'</a></div>';
				}
				$('#search_input').attr('data-content', popover_content);
  				$('#search_input').popover('show');
			}

		}// end of success ajax

	});//end of ajax

  });


	/* Ask Form */ 
	$('#askForm').submit(function(){
	//	alert();
		return true;
	});

}); // end of document ready

function submitAskForm(){
	method = 'post'; // Set method to post by default if not specified.
	path = 'ask/sendQuestion';

	var form = document.createElement('form');
	form.setAttribute('method', 'post');
	form.setAttribute('action', path);


	var city = document.createElement('input');
	city.setAttribute('type', 'hidden');
	city.setAttribute('value', document.getElementById("ask-city").value);
	city.setAttribute('name','city');
	form.appendChild(city);

	var place = document.createElement('input');
	place.setAttribute('type', 'hidden');
	place.setAttribute('value',document.getElementById("ask-place").value);
	place.setAttribute('name','place');
	form.appendChild(place);

	var question = document.createElement('input');
	question.setAttribute('type', 'hidden');
	question.setAttribute('value',document.getElementById("ask-question").value);
	question.setAttribute('name','question');
	form.appendChild(question);

	var token = document.createElement('input');
	token.setAttribute('type', 'hidden');
	token.setAttribute("name", '_token');
	token.setAttribute('value', $("#token").attr('content'));
	form.appendChild(token);

	form.submit();
}

function recordChatClick(){
	// alert('chat');
 	getUserCity('chat');
 }


function guestCity(){

	if (document.getElementById('guest-city')){
		pathArray = location.href.split( '/' );
		protocol = pathArray[0];
		host = pathArray[2];
		url = protocol + '//' + host;
		document.getElementById('guest-city').href = url + '/placenow/city/' + SessionRetrive('welcome-guest_city');
		//alert(UserInfo.city);
	}

}

function htmlCityOutput(result,type){
	if(type=='welcome-guest'){
		SessionStore('welcome-guest_city',UserInfo.city);
		guestCity();
	}
	if(type=="chat"){
		//alert('chat html output');
		var lat =SessionRetrive(type+"_lat");
		var lng =SessionRetrive(type+"_lng");
		var city = SessionRetrive(type+"_city");
		AjaxStorePosition(lat,lng,city,'chat');
	}
}


function AjaxStorePosition(lat,lng,user_city,action){
	// alert('chat position ajax');
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
        }
    })

	$.ajax({
		type:'POST',
		data:{
			lat:lat,
			lng:lng,
			action:action,
			city:user_city
		},
		url:'/placenow/storepositions',
		success:function(response){
		//	alert('chat posistion stored');
		pathArray = location.href.split( '/' );
		protocol = pathArray[0];
		host = pathArray[2];
		url = protocol + '//' + host;
			return window.location.href=url+'/placenow/chat';
	}});
}

