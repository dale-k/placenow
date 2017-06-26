$(document).ready(function(){
	
	$('[data-toggle="tooltip"]').tooltip();

	var $grid = $('.grid').masonry({
	    itemSelector: '.grid-item',
	    columnWidth: '.grid-sizer',
	    percentPosition: true
	  });
  $grid.imagesLoaded().progress( function() {
    $grid.masonry('layout');
  });





});