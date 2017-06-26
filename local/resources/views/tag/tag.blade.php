@extends('layouts.master')

@section('title','Tag - #'.$select_tag['tag'])

@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tag.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top_modified.css') }}">
<style>

</style>

@endsection

@section('content')
@include('layouts.top_new')
@include('layouts.tag_navbar2')

<div class="container-fluid wrap-content">
<div class="right-user-section col-md-3">
    <div class="col-md-4"></div>
    <div class="title-user col-md-8"> Popuplar User</div>
    <div class="col-md-4"></div>
    <div class="col-md-8 popular-user-wrapper ">
      
      <div class="user-info col-md-12">
        <div class="user-profile-img col-md-4">
        <img class="img-circle user-img img-responsive" src="{{ url('/img/profile-image.jpg') }}"/>
        </div>
        <div class="user-info-section col-md-8 no-padding">
          <div class="user-name col-md-8 no-padding"> Ritchie </div>
          <div class="user-follow-function col-md-4 no-padding"> Follow </div>
          <div class="following-count col-md-12 no-padding">Following:</div>
          <div class="follower-count col-md-12 no-padding">Follower:</div>
          <div class="post-count col-md-12 no-padding">Post:</div>
        </div>
      </div>
    </div>

</div>
<div class="middle-img-section col-md-6">	
		<div class="col-md-12 wrap-image">

			<div class="row img-container grid">
      <div class="col-xs-4 col-sm-6 col-md-4 grid-sizer"></div>
			  @foreach ( $tag_pictures as $tp )
        <div class="popular-img-wrap col-md-4 col-xs-4 grid-item">

          <div class="img-place col-md-12 col-xs-12">
              <div>
                <div class="shine-text-place">&nbsp;&nbsp;
                  <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                  &nbsp;   <a href="#" class="img-place-show" data-toggle="tooltip" title="{{$tp->place->city}}">{{ $tp->place->location }}&nbsp;&nbsp;</a>
                </div>
              </div>
          </div>
          
          <a href="{{url('/photo/'.$tp->id)}}">
            <img class='img-responsive' alt="" src="{{url($tp->pic_location)}}">
          </a>
          
          <div class="img-info col-md-12 col-xs-12">
            <div class="img-author-time"> 
              <div class="shine-text-time">
                &nbsp;&nbsp;by&nbsp;
                <a>{{$tp->user->user}}</a>&nbsp;,&nbsp;
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                    &nbsp;{{ trimCreatedAt($tp->created_at) }}&nbsp;&nbsp;
              </div>    
            </div>
          </div>
            <div class="tag-list col-md-12 col-xs-12">
              @foreach($tp->tag as $tag)
              <a href="{{url('tag/'.$tag->type)}}"> #{{$tag->type}} </a>&nbsp;
              @endforeach
            </div>
            
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