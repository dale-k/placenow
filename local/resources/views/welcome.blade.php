
@extends('layouts.master')

@section('title','Place Now - welcome')

@section('style')
  {{-- <link href='https://fonts.googleapis.com/css?family=PT+Sans:700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Berkshire+Swash' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Permanent+Marker' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'> --}}
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/welcome.css') }}">
@endsection

@section('content')

@include('layouts.top_new')


<div class="container-fluid padding-remove">

  {{-- <div class="col-md-12" style="margin-top:40px; margin-bottom:40px; border-top: 1px solid #d4d2d2;"></div> --}}

<div class="container padding-remove">
<div class="row padding-remove">
  <div class="wrap-margin">
    <div class="col-md-3 wrap-top-place-list top-picture-padding">
      <div class="top-place-title">
        <h2>TOP PLACES</h2>
        <hr class="top-place-title-bottom-border">
      </div>
      @for ( $i = 0; $i < count($popular_place); $i++ )
      <div class="top-place-list">
        <a class="" id="place-list" onmouseover="showhoverimg({{$i}});">{{$popular_place[$i][0]->place->location}}</a>
        <hr class="top-place-list-bottom-border">
      </div>
      @endfor
    </div>
    <div class="col-xs-12 col-md-5 top-place-middle">
      @for ( $i = 0; $i < count($popular_place); $i++ )
      <a href="{{url('photo/'.$popular_place[$i][0]->id)}}" class="col-xs-12 top-place-wrap-picture" id="place-info-{{ $i }}">
        <img class="img-responsive" alt="" src="{{$popular_place[$i][0]->pic_location}}">
        @if ( $popular_place[$i][0]->title != '' )
          <h3>{{ $popular_place[$i][0]->title }}</h3>
        @endif
      </a>
      <div class="col-xs-12 top-place-img-info">
        @if ( $popular_place[$i][0]->title != '' )
        <h3>{{ $popular_place[$i][0]->title }}</h3>
        @endif
      </div>
      @endfor
    </div>
    <div class="col-md-4 top-place-right padding-remove">
      @for ( $i = 0; $i < count($popular_place); $i++ )
        <div class="wrap-pictures-from-place" id="place-picture-{{ $i }}">
          @for ( $j = 1; $j < count($popular_place[$i]); $j++ )
          <div class="col-md-6 top-picture-padding">
            <a href="{{ url('photo/'.$popular_place[$i][$j]->id) }}" class="top-place-2-wrap-picture">
              <img class="img-responsive" alt="" src="{{ url($popular_place[$i][$j]->pic_location) }}">
            </a>
          </div>
          @endfor
        </div>
      @endfor
      @for ( $k = 0; $k < count($popular_place); $k++ )
      {{-- <div class="wrap-info-about-place col-md-12" id="place-picture-{{ $i }}">
        
        <div class="tp-follower">
          <span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>
          100 followers
        </div>
        <div class="tp-current-num-ppl">
          <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
          100 ppl
        </div>
        <div class="tp-num-photo-uploaded">
          <span class="glyphicon glyphicon-upload" aria-hidden="true"></span>
          1000 posts
        </div>
        <div class="tp-wrap-top-tag">
          <div>Top Tags</div>
            @foreach ( $popular_place[$i]->tag as $type )
            <a>#{{ $type->type }}</a>
            @endforeach
        </div>
        
      </div> --}}
      @endfor
    </div>
  </div>
 


</div><!-- end of row -->

<div class="row">

  <div class="col-xs-12 col-md-6 padding-remove">
    <div class="col-md-12 top-picture-padding">
      <h3 class="city-title">Popular City</h3>
    </div>
    @for ( $i = 0; $i < count($popular_city); $i++ )
    <a class="col-xs-12 col-md-12 city-list" href="{{ url('city/'.$popular_city[$i]->place->city) }}">
      @if ($i == 0)
      {{-- <h3 class="tag-title">Popular Tags</h3> --}}
      @endif
      <img class="img-responsive" alt="" src="{{ url( $popular_city[$i]->pic_location ) }}" class="">
      {{-- <div>#{{ $popular_city[$i]->tag->type }}</div> --}}
    </a>
    @endfor
  </div>

  <div class="col-xs-12 col-md-6 padding-remove">
    <div class="col-md-12 top-picture-padding">
      <h3 class="tag-title">Popular Tags</h3>
    </div>
  @for ( $i = 0; $i < count($popular_tag); $i++ )
  <a class="col-xs-6 col-md-6 tag-list" href="{{ url('tag/'.$popular_tag[$i]->type) }}">
    @if ($i == 0)
    {{-- <h3 class="tag-title">Popular Tags</h3> --}}
    @endif
    <img class="img-responsive" alt="" src="{{ $popular_tag_pic[$i]->pic_location }}" class="">
    <div>#{{ $popular_tag[$i]->type }}</div>
  </a>
  @endfor
  </div>

</div>

</div>

</div>


<div class="container wrap-fluid-latest padding-remove">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-12 padding-remove">
      <h3 class="latest-title">Latest</h3>
    </div>
  </div>
  <div class="row grid">
    <div class="col-xs-12 col-sm-6 col-md-4 grid-sizer"></div>
  @foreach ($latest as $i)
    <div class="col-xs-12 col-sm-6 col-md-4 wrap-latest grid-item">
      <div class="wrap-latest-time">
        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
        <p class="place-posted-at">{{ trimCreatedAt($i->created_at) }}</p>
      </div>
      <a href="{{url('/photo/'.$i->id)}}" class="wrap-latest-img">
        <img class="img-responsive" alt="" src="{{$i->pic_location}}">
        <div class="wrap-vote-count">
          <span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>
          {{ $i->vote_count }}
        </div>
      </a>
      <div class="latest-info tag-color">
        <div class="wrap-latest-tags tag-color">
          <a class="">#{{ $i->place->location }}</a>
          @foreach ( $i->tag as $tag )
            <a class="">#{{ $tag->type }}</a>
          @endforeach
        </div>
        @if ($i->title != '')
          <div class="latest-title"><h3>{{$i->title}}</h3></div>
        @endif
        <div class="latest-comment"><p>{{$i->comment}}</p></div>
      </div>
    </div>
  @endforeach
  </div>
</div>

<div class="container latest-container">

  <div class="row">

    <div class="">



    </div>

  </div>


</div>



@endsection

@section('script')
<script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<script src="{{ URL::asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('js/welcome.js') }}"></script>
@endsection