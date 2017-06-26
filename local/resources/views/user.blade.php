@extends('layouts.master')

@section('title','Place Now - welcome')

@section('style')
  {{-- <link href='https://fonts.googleapis.com/css?family=PT+Sans:700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Berkshire+Swash' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Permanent+Marker' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'> --}}
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top_modified.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/user.blade.css') }}">
@endsection

@section('content')

@include('layouts.top_new')




@foreach ( $pictures as $pic )
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="{{url('/photo/'.$pic->id)}}" class="wrap-img">
				<img class="img-responsive" alt="" src="{{url($pic->pic_location)}}">
				<div class="wrap-vote-count">
					<span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>
					{{ $pic->vote_count }}
				</div>
			</a>
			<div class="latest-info tag-color">
				<div class="wrap-latest-tags tag-color">
					<a class="">#{{ $pic->place->location }}</a>
					@foreach ( $pic->tag as $tag )
					<a class="">#{{ $tag->type }}</a>
					@endforeach
				</div>
				@if ($pic->title != '')
				<div class="latest-title"><h3>{{$pic->title}}</h3></div>
				@endif
				<div class="latest-comment"><p>{{$pic->comment}}</p></div>
			</div>
		</div>
	</div>
</div>

@endforeach


@endsection

@section('script')
<script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<script src="{{ URL::asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('js/welcome.js') }}"></script>
@endsection