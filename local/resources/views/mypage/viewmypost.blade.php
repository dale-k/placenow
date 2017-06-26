
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
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/viewmypost.blade.css') }}">
@endsection

@section('content')

@include('layouts.top_new')



<!-- view post Modal -->

<div class="container wrap-margin">

  <div class="row">

    <div class="col-md-1">
    </div>

    <div class="col-md-6">
      @if ($post->photo != 'text')
      <img src="{{ createDataURL($post->pic_location) }}" class="img-responsive" alt="">
      @endif
    </div>

    <div class="col-md-4">

      <div>{{ $post->place->city }}</div>
      <div>{{ $post->place->location }}</div>
      <div>{{ $post->title }}</div>
      <div>{{ $post->comment }}</div>
      <div>
        @foreach ( $post->tag as $tag )
          #{{ $tag->type }}
        @endforeach
      </div>

      <div>
        <button class="btn"><a href="{{ url('/me/mypage/post/edit/'.base64_encode($post->id) ) }}">Edit</a></button>
        <button class="btn"><a href="{{ url('/me/mypage/post/delete/'.base64_encode($post->id) ) }}">Delete</a></button>
      </div>

    </div>



    <div class="col-md-1">
    </div>

  </div>

</div>

<!-- -->

@endsection

@section('script')
{{-- <script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<script src="{{ URL::asset('js/imagesloaded.pkgd.min.js') }}"></script> --}}
{{-- <script src="{{ URL::asset('js/mypost.js') }}"></script> --}}
<script type="text/javascript">

</script>
@endsection