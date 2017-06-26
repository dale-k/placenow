@extends('layouts.master')

@section('title','Place Now')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top_modified.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/nearby.blade.css') }}">
<style type="text/css">

</style>
@endsection

@section('content')

@include('layouts.top_new')

<div class="container-fluid wrap-margin">

  <div class="row">

  </div>

	<div class="row grid">

    <div class="col-xs-12 col-sm-6 col-md-3 grid-sizer"></div>


		@foreach ($nearbyplace_picture as $np)
		<div class="col-xs-12 col-sm-6 col-md-3 wrap-nearby grid-item padding-around">

      <div class="nearby">

  			<a href="{{ url('photo/'.$np->id) }}" class="wrap-nearby-img">
      		<img class="img-responsive" alt="Responsive image" src="{{ url($np->pic_location) }}">
        </a>

        <div class="nearby-content">

          <a class="nearby-location" href="{{ url( 'place/'.$np->place->location ) }}">
            <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
            {{ $np->place->location }} ( {{ roundDistance($np->distance) }} )
          </a>

          @if ( $np->title != '' )
            <h4>{{ $np->title }}</h4>
          @endif

          @if ( $np->comment != '' )
            <p>{{ $np->comment }}</p>
          @endif

          @if (count($np->tag)>0)
            <div class="wrap-tags">
            @foreach ($np->tag as $tag)
              <a href="">#{{ $tag->type }}</a>
            @endforeach
            </div>
          @endif
          <div class="wrap-user-time">
            <div class="nearby-user">By {{ $np->user->user }},</div> 
            <div class="nearby-when">{{ trimCreatedAt($np->created_at) }}</div>
          </div>
        </div>

  		</div>
    </div>
		@endforeach

	</div>

</div>


@endsection

@section('script')
<script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<script src="{{ URL::asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('js/nearby.blade.js') }}"></script>
@endsection