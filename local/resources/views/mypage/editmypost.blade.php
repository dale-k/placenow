
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
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/viewmypost.blade.css') }}">
@endsection

@section('content')

@include('layouts.top_new')



<!-- view post Modal -->

<div class="container wrap-margin">

  <div class="row">

    <div class="col-md-2 sidebar">
      @include('mypage.sidebar')
    </div>
    <script type="text/javascript">$('#li_post').addClass('sidebar-active');</script>

    <div class="col-md-6">
      @if ($post->photo != 'text')
      <img src="{{ createDataURL($post->pic_location) }}" class="img-responsive" alt="">
      @endif
    </div>

    <div class="col-md-4">
      <form class="form-horizontal" role="form" method="POST" action="{{ url( '/me/mypage/post/saveEdit/'.base64_encode($post->id) ) }}">
        {{ csrf_field() }}
      
        <div>{{ $post->place->city }}</div>
        <div>{{ $post->place->location }}</div>

      
        <input type="text" id="title" class="form-control" name="title" style="margin-bottom:5px;" value="{{ $post->title }}" >
        <input type="text" id="tags" class="form-control" name="tags" onKeyUp="tagKeyup();" style="margin-bottom:5px;" value="@foreach ( $post->tag as $tag )#{{ $tag->type }}@endforeach" >
        <textarea id="comment" class="form-control" name="comment" style="margin-bottom:3px;" rows="5" col="30" >{{ $post->comment }}</textarea>

        <div>
          <button class="btn">Save</button>
          <a href="{{ back() }}" class="btn">Cancel</a>
        </div>

      </form>
    </div>

  </div>

</div>

<!-- -->

@endsection

@section('script')
{{-- <script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<script src="{{ URL::asset('js/imagesloaded.pkgd.min.js') }}"></script> --}}
{{-- <script src="{{ URL::asset('js/mypost.js') }}"></script> --}}
<script src="{{ URL::asset('js/uploadmyphoto.js') }}"></script>
<script type="text/javascript">

</script>
@endsection