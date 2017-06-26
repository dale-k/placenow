
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
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/myaccount.blade.css') }}">
@endsection

@section('content')

@include('layouts.top_new')



<div class="container wrap-margin">

  <div class="row">

    <div class="col-md-2 sidebar">
      @include('mypage.sidebar')
    </div>
    <script type="text/javascript">$('#li_account').addClass('sidebar-active');</script>

    <div class="col-md-2"></div>

    <div class="col-md-4 wrap-form">

      <form class="form-horizontal" role="form" method="POST" action="{{ url('/me/myaccount/saveMyAccount') }}">

        <div class="form-group">

          <label for="name">User Name</label>

          <input type="text" name="name" class="form-control" id="name" value="{{ $db_user->user }}">

          @if ($errors->has('name'))
              <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif

        </div>

        <div class="form-group">

          <label for="email">E-Mail address</label>

          <input type="email" name="email" class="form-control" id="email" value="{{ $db_user->email }}" >

          @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif

        </div>

        <div class="form-group">

          <label for="password">New Password</label>

          <input type="password" name="newpassword" class="form-control" id="exampleInputEmail1" >

        </div>

        <button type="submit" class="btn btn-warning">Save</button>

        <a role="button" class="btn btn-default">Cancel</a>

      </form>

    </div>

    <div class="col-md-3" style="min-height:1px;"></div>

  </div>

</div>
<!-- end container -->

@endsection

@section('script')
<script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<script src="{{ URL::asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('js/myaccount.js') }}"></script>
@endsection