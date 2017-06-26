@extends('layouts.master')

@section('title','Place Now - tagtest')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top_modified.css') }}">
<style type="text/css">
 

/*tag-whole page*/
.tag-content{
  margin-top:55px;
}
/* top-part */
.row-1{
  margin-bottom:5px;
}
.top-part-leftbar{
    height:500px;
    padding:0px;
}
.img-container{
    padding: 0px;
    padding-right:5px;
    padding-left:5px;
    margin-top:10px;
    margin-bottom: 10px;
}
.tag-type{
  background-color: #2976f6;
  padding:10px;
}
div.tag-text{
    
    text-align: center;
}
div.tag-text a{
    font-size: 16px;
    color:white !important;
}

.img-link{
    padding:0px;
}

/* bottom-part */
.bottom-part{
  background-color: #9fd7fb;
}

.tag-list{
  padding:0px;
}

.tag-list{
  font-size: 25px;
  padding-left:2px;


}

.tag-list a{
  background-color: #2976f6;
  color:white;
  margin-right:3px;
  padding:3px;
  border-radius: 2px;
}

.latest-img-wrap , .popular-img-wrap{
  
  padding:15px;
  padding-top:20px;
}

.row-1-2{
  position: relative;
  margin-bottom:30px;
}

div.container-left, div.container-right{
  
  margin-top: 20px;
  padding:0px;
  
}
div.container-left{
  border-right: 5px dashed blue;
}
h1.center-title{

  margin:0 auto;
  background-color: #f9f6f6;
  font-family: "Arial Black", Gadget, sans-serif;
  padding-top: 10px;
  padding-bottom: 10px;
  width:40%;
  text-align: center;
}
hr{
  margin:0;
  padding-top:20px;
  padding-bottom:20px;
}
img.display-img{
  border-radius: 3px;
}

/*img place and user , time */

div.img-place > div{
  font-size:15px;
  position: absolute;
  top:5px;
  left:0px;
  background-color:#ff4747;
  white-space:nowrap;
  overflow:hidden;
  width:30%;
}

/*#f9f6f6*/
div.img-author-time{
  position: absolute;
  bottom:5px;
  right:5px;
  background-color: #f9f6f6;
  border-radius: 5px;
  /*opacity: 0.6;*/
}
div.shine-text{
  color:white;

}
div.shine-text-place a, .glyphicon-map-marker{
  color:white !important;
  cursor:pointer;
}

div.shine-text-time a{
  color:black !important;
  cursor:pointer;
}



</style>

@endsection

@section('content')
@include('layouts.top_new')
<div class="container-fluid tag-content">

<div class="row row-1 top-part">

<div class="col-md-1 top-part-leftbar"></div>
 <div class="col-md-2 col-xs-5"></div>
        @for($i = 0 ; $i < 10 ; $i++)
        <div class="img-container col-md-2 col-xs-5">
            <div class="tag-type col-md-12 col-xs-12">
                <div class="tag-text"><a href="{{url('/tag/'.$tags[$i]->type)}}">#{{$tags[$i]->type}}</a></div>
            </div>
            <div class="img-link col-md-12 col-xs-12">
            <a class="" href="{{url('/photo/'.$tags[$i]->post_id)}}">
                <img class='img-responsive' alt="" src="{{$tags[$i]->pic_location}}">
            </a>
            </div>

        </div>
        @endfor
</div>

<div class="row bottom-part">
     <div class="container-left col-md-6 col-xs-12">
      <h1 class="center-title">latest</h1>
      <div class="latest-img-container grid">
      <div class="grid-sizer col-md-6 col-xs-6"></div>
        @foreach($latest_pictures as $lpicture)
        <div class="latest-img-wrap col-md-6 col-xs-6 grid-item">

          <div class="tag-list col-md-12 col-xs-12">
              @foreach($lpicture->tag as $tag)
              <a href="{{url('tag/'.$tag->type)}}"> #{{$tag->type}} </a>&nbsp;
              @endforeach
            </div>
          <div class="img-place col-md-12 col-xs-12">
              <div>
                <div class="shine-text-place">&nbsp;&nbsp;
                  <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                  &nbsp;   <a href="#" class="img-place-show" data-toggle="tooltip" data-placement="bottom" data-delay='{"show":"0", "hide":"100"}' title="@ {{ $lpicture->place->location }}">{{$lpicture->place->city}}&nbsp;&nbsp;</a>
                </div>
              </div>
          </div>
          
          <a href="{{url('/photo/'.$lpicture->id)}}">
          <img class='img-responsive display-img' alt="" src="{{$lpicture->pic_location}}"></a>
            <div class="img-info col-md-12 col-xs-12">
            <div class="img-author-time"> 
              <div class="shine-text-time">
                &nbsp;&nbsp;by&nbsp;
                <a>{{$lpicture->user->user}}</a>&nbsp;,&nbsp;
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                    &nbsp;{{ trimCreatedAt($lpicture->created_at) }}&nbsp;&nbsp;
              </div>    
            </div>
          </div>

        </div>
        @endforeach
      </div>
    </div>



    <div class="container-right col-md-6 col-xs-12">
      <h1 class="center-title">popular</h1>
      <div class="popular-img-container grid">
      <div class="grid-sizer col-md-6 col-xs-6"></div>
        @foreach($popular_pictures as $ppicture)
        <div class="popular-img-wrap col-md-6 col-xs-6 grid-item">

        <div class="tag-list col-md-12 col-xs-12">
              @foreach($ppicture->tag as $tag)
              <a href="{{url('tag/'.$tag->type)}}"> #{{$tag->type}} </a>&nbsp;
              @endforeach
            </div>
          <div class="img-place col-md-12 col-xs-12">
              <div>
                <div class="shine-text-place">&nbsp;&nbsp;
                  <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                  &nbsp;   <a href="#" class="img-place-show" data-toggle="tooltip" data-placement="bottom" data-delay='{"show":"0", "hide":"100"}' title="@ {{ $lpicture->place->location }}">{{$lpicture->place->city}}&nbsp;&nbsp;</a>
                </div>
              </div>
          </div>
          
          <a href="{{url('/photo/'.$ppicture->id)}}">
          <img class='img-responsive display-img' alt="" src="{{$ppicture->pic_location}}"></a>
            <div class="img-info col-md-12 col-xs-12">
            <div class="img-author-time"> 
              <div class="shine-text-time">
                &nbsp;&nbsp;by&nbsp;
                <a>{{$ppicture->user->user}}</a>&nbsp;,&nbsp;
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                    &nbsp;{{ trimCreatedAt($ppicture->created_at) }}&nbsp;&nbsp;
              </div>    
            </div>
          </div>

        </div>
        @endforeach
      </div>
    </div>

   
    
    

</div>
@endsection

@section('script')
<script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<script src="{{ URL::asset('js/imagesloaded.pkgd.min.js') }}"></script>


<script>

$(document).ready(function(){

    var $grid = $('.grid').masonry({
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true
    });

    $grid.imagesLoaded().progress( function() {
        $grid.masonry('layout');
    });


});


</script>
@endsection