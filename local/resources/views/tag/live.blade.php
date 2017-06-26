@extends('layouts.master')

@section('title','Tag - #'.$select_tag['tag'].' - Live')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tag.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top_modified.css') }}">
<style>
.uploader-profile-image {
	width: 20px;
}
.img-comment{
	padding-top:20px;
}
hr {
   border: 1px; 
  height: 1px; 
  background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
}
</style>

@endsection
@section('tag-type',' - Live')
@section('content')
@include('layouts.top_new')
@include('layouts.tag_navbar2')

<div class="container">


	<div class="row wrap-content">
		
  	<div class="col-md-2" style="height:1px;"></div>
		<div class="col-md-8 wrap-image">



<div class="row img-container">
	@foreach($livetag_pictures as $picture)
	<div class="img-each-wrap col-md-12 col-xs-12">
		<div class="popular-img-wrap col-md-6 col-xs-12">
          <span class="glyphicon glyphicon-time" aria-hidden="true"></span>&nbsp;{{ trimCreatedAt($picture->created_at) }}
          <a href="{{url('/photo/'.$picture->id)}}">
          <img class='img-responsive' alt="" src="{{url($picture->pic_location)}}"></a>
          <div class="img-counts col-md-12 col-xs-12">
             <div class="col-md-3 col-xs-3 pic-counts"> {{$picture->vote_count}} <span class="glyphicon glyphicon-heart" aria-hidden="true"></span></div>
             <div class="col-md-3 col-xs-3 pic-counts">{{$picture->favor_count}}<span class="glyphicon glyphicon-star" aria-hidden="true"></span></div>
             <div class="col-md-3 col-xs-3 pic-counts"> {{$picture->recommend_count}} <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></div>
             <div class="col-md-3 col-xs-3 pic-counts"> {{$picture->view_count}} <span class="glyphicon glyphicon-play" aria-hidden="true"></span></div>
          </div>
            <div class="tag-list col-md-12 col-xs-12">
              @foreach($picture->tag as $tag)
              <a href="{{url('tag/'.$tag->type)}}"> #{{$tag->type}} </a>&nbsp;
              @endforeach
            </div>
            
        </div>
        <div class ="img-comment col-md-6 col-xs-12">
			<div class="media col-md-12 col-xs-12">
			  <div class="media-left">
			    <a href="#">
			      <img src="{{ url('/img/profile-image.jpg') }}" alt="" class="media-object img-circle uploader-profile-image image-responsive">
			    </a>
			  </div>
			  <div class="media-body">
			    <h4 class="media-heading">
					<a class ="author" href="{{ url('/people/'.$picture->user->user) }}">{{ $picture->user->user }}</a>
			    </h4>
			    
			    <div class="pic_comment no-padding"> {{ $picture->comment }}</div>
			    
			  </div>
			</div>
        </div>
   	 <hr class="col-md-12 col-xs-12">
    </div>
   
	@endforeach
</div>





		</div>    
	</div>

</div>



@section('script')
<script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<script src="{{ URL::asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('js/tag.js') }}"></script>
<script>
$( document ).ready(function() {

$('.img-comment').each(function(){
	$(this).height($(this).parent().find('.popular-img-wrap').height());
	//console.log($(this).parent().find('.popular-img-wrap').height());
});

});


</script>
@endsection