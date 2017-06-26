
@extends('layouts.master')

@section('title','Place Now - welcome')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/index.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/welcom_carousel.css') }}">
    <style type="text/css">
      .content-top {
        padding-top: 10px;
        padding-bottom: 10px;
      }

      .glyphicon {
        top: 3px !important;
      }
      .share-photo {
        background-color: #c1253e;
      }
      .join-chat {

      }

      .grid:after {
        content: '';
        display: block;
        clear: both;
      }

      #dropdown-sort{
        margin-left:3px;
        margin-bottom:5px;
      }

      

      /* Medium devices (desktops, 992px and up) */
      @media (min-width: 992px) {
        .grid-item img {
          width: 100% !important;
        }
      }
    </style>
@endsection

@section('top')
@overwrite

@section('content')


<div class="container-fluid wrap-guest-content" id="wrap_guest_content">
  <div class="navbar-wrapper container-fluid wrap-guest-nav">
    <div class="container">

      <nav class="navbar">
        <div class="container">
          <div class="navbar-header">
              <a class="navbar-brand" href="{{ url('/') }}">What's Happening</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-right">
              <!-- Authentication Links -->
              <li><a href="{{ url('/login') }}">Login</a></li>
              <li><a href="{{ url('/register') }}">Register</a></li>

            </ul>
            
          </div>
        </div>
      </nav>

    </div>
</div>
  <div class="row">

    <div class="col-xs-12 col-md-6 wrap-guest-btn guest-grid-padding">
      <a href="/placenow/postmyphoto" class="guest-share-photo" role="button">
        <div class="wrap-btn-content">
          <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
          <p>share your photo with everyone</p>
        </div>
        <div class="wrap-photo-imgs grid">
          <div class="grid-sizer"></div>
          @foreach ($latest_picture as $i)
            <div class="grid-item">
              <img src="{{ url($i->pic_location) }}">
            </div>
          @endforeach
        </div>
      </a>
    </div>

    {{-- <div class="col-xs-12 col-md-4 wrap-guest-btn guest-grid-padding">
      <a href="/placenow/welcome" class="guest-search-area" role="button">
        <div class="wrap-btn-content">
          <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
          <p>find out what's happening in your place</p>
        </div>
      </a>
    </div> --}}

    <div class="col-xs-12 col-md-6 wrap-guest-btn guest-grid-padding">
      <a href="/placenow/chat" class="guest-join-chat" role="button">
        <div class="wrap-btn-content">
          <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
          <p>talk to your neighbor</p>
        </div>
      </a>
    </div>
  </div>

</div>

@endsection

@section('script')
<script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<script src="{{ URL::asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('js/welcome.js') }}"></script>
<script type="text/javascript">


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