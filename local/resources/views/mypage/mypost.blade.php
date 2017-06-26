
@extends('layouts.master')

@section('title','Place Now - My Account')

@section('style')
  {{-- <link href='https://fonts.googleapis.com/css?family=PT+Sans:700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Berkshire+Swash' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Permanent+Marker' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'> --}}
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top_modified.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mypage/sidebar.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mypost.blade.css') }}">
@endsection

@section('content')

@include('layouts.top_new')



<div class="container wrap-margin">

  <div class="row">

    <div class="col-md-2 sidebar">
      @include('mypage.sidebar')
    </div>
    <script type="text/javascript">$('#li_post').addClass('sidebar-active');</script>

    <div class="col-md-2"></div>

    <div class="col-md-10 grid">

      <div class="col-md-3 grid-sizer"></div>

      @foreach ($posts as $post)
      <div class="col-xs-12 col-sm-6 col-md-3 grid-item padding-around">

        <div class="mypost" >

          @if ($post->photo != 'text')
          <a href="{{ url('/me/mypage/post/view/'.base64_encode($post->id) ) }}" class="wrap-mypost-img">
            <img class="img-responsive" alt="Responsive image" src="{{ url($post->pic_location) }}">
          </a>

          <div class="mypost-content">

            <a class="mypost-location" href="{{ url( 'place/'.$post->place->location ) }}">
              <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
              {{ $post->place->location }}
            </a>

            <div class="post_count">
              <div><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>&nbsp;{{$post->vote_count}}</div>
              <div><span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;{{$post->favor_count}}</div>
              <div><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;{{$post->recommend_count}}</div>
            </div>

            <div class="wrap-user-time">
              <div class="mypost-when">
                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                {{ trimCreatedAt($post->created_at) }}
              </div>
            </div>

          </div>
          @else
          <!-- Only Text -->


          @endif

        </div>
      </div>
      @endforeach

    </div>

  </div>

</div>
<!-- end container -->

@endsection

@section('script')
<script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<script src="{{ URL::asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('js/mypost.js') }}"></script>
@endsection