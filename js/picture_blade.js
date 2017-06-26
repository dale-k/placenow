
$(document).ready(function(){

    // if ((screen.width>=320) && (screen.width>=420)) {
      var offset = $('.img-now').offset();
      var position = $('.img-now').position();
    $('.timeline-display').scrollTop(offset.top-50);
    console.log('position : '+position.top+"  ,  offset : "+offset.top);
    // }else{
    // $('.timeline-display').scrollTop($('.img-now').offset().top);
    // }

    // resize img width
  $('img.shown').each(function(){
      if($(this).width()>$(this).parent().width())
        $(this).addClass('img-responsive');
        $(this).removeClass('img-hidden');
  });
// adjust the height for each image comment section
  // other images
   $('.comment_section').each(function(){
      $(this).height($('.no-padding').height());
   });
  //now
  $('.comment_section').each(function(){
      $(this).height($('.image-now').height() + $('#mid_section').height() );
  });





  $('.btn-loadbefore').click(function(e){
     
      $now = $('.show-img');
      $prev = $now.prev();
      

      if($prev.hasClass('first-img')) $(this).text("Load More");
      if( $('.btn-loadafter').text()=='Load More')$('.btn-loadafter').text("Load After");
      $now.removeClass('show-img');
      $now.addClass('hidden-img');
      $prev.removeClass('hidden-img');
      $prev.addClass('show-img');
      


  });
  
  $('.btn-loadafter').click(function(e){

      $now = $('.show-img');
      $next = $now.next();

      if($next.hasClass('last-img')) $(this).text("Load More");
      if($('.btn-loadbefore').text()=='Load More') $('.btn-loadbefore').text("Load Before");
        $now.removeClass('show-img');
        $now.addClass('hidden-img');
        $next.removeClass('hidden-img');
        $next.addClass('show-img');
      
      


  });





}); // end of document ready

function scroolToMovePoint(event){
  var currPoint = document.getElementById('moving-point').offsetTop;
  
  var delta = 0;
  if(!event) event = window.event;
  if(event.wheelDelta){
    delta = event.wheelDelta / 60;
  }else if (event.detail){
    delta = -event.detail / 2
  }
  var timeline = document.getElementById('timelime-right');
  var topend = timeline.getBoundingClientRect();
  var firstpoint = timeline.firstChild;
  var lastpoint = timeline.lastChild;
  console.log("first Y : "+ firstpoint +" , point Y : "+currPoint+"  ,    last Y : " + lastpoint + "\n");
  currPoint = parseInt(currPoint)-(delta*10)-10;
  if(currPoint>-13&&currPoint<754){
  document.getElementById('moving-point').style.top = currPoint+'px';
  }
}

function postVote(option,value){
	method = 'post'; // Set method to post by default if not specified.
  	path = '/placenow/vote';

  	var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

  	var optionInput = document.createElement('input');
  	optionInput.setAttribute('type', 'hidden');
  	optionInput.setAttribute("name", 'options');
  	optionInput.setAttribute('value', option);
  	form.appendChild(optionInput);

  	var select = document.createElement('input');
  	select.setAttribute('type', 'hidden');
  	select.setAttribute("name", 'select');
  	select.setAttribute('value', 1);
  	form.appendChild(select);

  	var valueInput = document.createElement('input');
  	valueInput.setAttribute('type', 'hidden');
  	valueInput.setAttribute("name", 'value');
  	valueInput.setAttribute('value', value);
  	form.appendChild(valueInput);

  	var token = document.createElement('input');
  	token.setAttribute('type', 'hidden');
  	token.setAttribute("name", '_token');
  	token.setAttribute('value', $("#token").attr('content'));
  	form.appendChild(token);

  	// Submit form
  	form.submit();


    if(option==0){
      $('#vote_btn').attr('disabled');
    }else if(option==1){
      $('#favor_btn').attr('disabled');
    }else{
      $('#recommend_btn').attr('disabled');
    }
}