
$(document).ready(function(){
	if($("#login")){
		getUserCity('welcome-guest');
	}else{
		getUserCity('welcome');	
	}
	

	var $grid = $('.grid').masonry({
	    itemSelector: '.grid-item',
	    columnWidth: '.grid-sizer',
	    percentPosition: true
	  });
  $grid.imagesLoaded().progress( function() {
    $grid.masonry('layout');
  });





});

function checkSessionToReload(newlat, newlng){

	

}


function showhoverimg(index) {
	$('.wrap-info-about-place').hide();
	$('.top-place-wrap-picture').hide();
	$('.wrap-pictures-from-place').hide();
	$('#place-picture-'+index).show();
	$('#place-info-'+index).show();
}


