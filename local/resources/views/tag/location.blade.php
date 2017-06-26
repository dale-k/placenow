@extends('layouts.master')

@section('title','Tag - #'.$select_tag['tag'].' - Location')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tag.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top_modified.css') }}">
<style>

</style>

@endsection
@section('tag-type',' - Location')
@section('content')
@include('layouts.top_new')
@include('layouts.tag_navbar2')
<div class="container">


	<div class="row wrap-content">
		
  	<div class="col-md-2" style="height:1px;"></div>
		<div class="col-md-8 wrap-image">


@section('load-image')
<div class="row img-container">
	@foreach( $loctag_pictures as $place )
		<div class="place-name"><h2>{{$place->location}}</h2></div>
		<div class="row img-container">
			@foreach($place->picturebydate(5) as $picture)
				<div class="popular-img-wrap col-md-4 col-xs-12">
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
			@endforeach
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

@endsection