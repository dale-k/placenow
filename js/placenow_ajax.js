$(document).ready(function(){

	var date = new Date();
	var currentHour = date.getHours() * 3600;
	var currentMin = date.getMinutes() * 60;
	var currenctSec = date.getSeconds();

	var current_time_in_sec = currentHour + currentMin + currenctSec;

	localStorage.setItem('current_time_in_sec', current_time_in_sec);

	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
            }
        })

	$.ajax({
		type:'POST',
		data:{
			current_time_in_sec:current_time_in_sec
		},
		url:'/placenow/ajax',
		success:function(response){
			


		}// end of success ajax

	});//end of ajax

});