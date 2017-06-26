
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
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mypage.blade.css') }}">
@endsection

@section('content')

@include('layouts.top_new')



<div class="container wrap-margin">

  <div class="row">

    <div class="col-md-2 sidebar">
      @include('mypage.sidebar')
    </div>
    <script type="text/javascript">$('#li_page').addClass('sidebar-active');</script>

    <div class="col-md-2" style="min-height: 1px;"></div>

    <div class="col-md-6">

      @foreach ( $posts as $post )
      <div class="col-md-12">

        @if ( $post->post_type == 'mypost' )

          @if ($post->photo != 'text')
          <div class="col-md-3">
            <img class="img-responsive" alt="" src="{{ createDataURL($post->pic_location) }}">
          </div>
          @endif
          <div class="col-md-9">
            {{ trimCreatedAt($post->created_at) }}
            {{ $post->vote_count }}
          </div>

        @elseif ( $post->post_type == 'fUser' )

          @if ($post->photo != 'text')
          <div class="col-md-12">
            <img class="img-responsive" alt="" src="{{ createDataURL($post->pic_location) }}">
          </div>
          @endif

        @elseif ( $post->post_type == 'fPlace' )

        @elseif ( $post->post_type == 'fCity' )

        @endif

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
<script src="{{ URL::asset('js/mypage/mypage.blade.js') }}"></script>
{{-- <script src="{{ URL::asset('js/placenow_ajax.js') }}"></script> --}}
@endsection