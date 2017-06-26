@extends('layouts.master')
@section('style')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/uploadmyphoto.css') }}">
@endsection

@section('title','Place Now - Post')

@section('top')
@overwrite

@section('content')


	<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6 wrap-all" style="padding: 0;">
				<div class="wrap-nav">
					<div class="col-xs-2 wrap-go-back-btn" onclick="prevStep();">
						<span class="glyphicon glyphicon-chevron-left go-back-btn" aria-hidden="true"></span>
					</div>
					{{-- <div class="col-xs-9 nav-header" id="pageHeader1">
						<h1>Post My Photo</h1>
					</div> --}}
					<div class="col-xs-8 nav-header">
						<a href="">Post My Photo</a>
						{{-- <span class="glyphicon glyphicon-camera go-back-btn" aria-hidden="true"></span> --}}
					</div>
					<div class="col-xs-2">
						<span class="glyphicon glyphicon-align-justify go-back-btn" id="dk-mobile-menu-opener" aria-hidden="true"></span>
					</div>
				</div>

				<div class="col-md-12 dk-mobile-menu-list padding-remove" id="dk-mobile-menu-list">
				    <a href="{{ url('/welcome') }}" class="col-xs-12 dk-menu-list">
				      World
				    </a>
				    @if ( Auth::guest() )
				      <a id="guest-city" onclick="guestCity();" class="col-xs-12 dk-menu-list">City</a>
				    @else
				      <a href="{{  url('/city/'.Auth::user()->getUserCity()) }}" class="col-xs-12 dk-menu-list">{{  Auth::user()->getUserCity() }}</a>
				    @endif
				    <a href="{{ url('nearby') }}" class="col-xs-12 dk-menu-list">
				      NearBy
				    </a>
				    <a href="{{url('/tag')}}" class="col-xs-12 dk-menu-list">
				      Tags
				    </a>
				    <a href="/placenow/postmyphoto" class="col-xs-12 dk-menu-list">
				      Post
				    </a>
				    <a class="col-xs-12 dk-menu-list" onclick="recordChatClick();return window.location.href='{{url('/chat')}}';">
				      Chat
				    </a>
				    <a class="col-xs-12 dk-menu-list" data-toggle="modal" data-target="#searchModal">
				      search
				    </a>
				    @if ( !Auth::guest() )
				    <a href="#collapseAsk" class="col-xs-12 dk-menu-list" data-toggle="modal" data-target="#askModal">
				      Ask
				    </a>
				    <a href="{{ url('/profile') }}" class="col-xs-12 dk-menu-list">
				      Profile
				    </a>
				    <a href="{{ url('/me/myaccount') }}" class="col-xs-12 dk-menu-list">
				      Mypage
				    </a>
				    <a href="{{ url('/logout') }}" class="col-xs-12 dk-menu-list">
				      Logout
				    </a>
				    @else
				    <a id ="login" class="col-xs-12 dk-menu-list" href="{{ url('login') }}">Login</a>
				    <a id="register" class="col-xs-12 dk-menu-list" href="{{ url('register') }}">Register</a>
				    @endif
				</div>

				<div class="col-md-12">
					<div id="map"><!--<input type="hidden" id="hiddens" name="_token" value="{{ csrf_token() }}">--></div>
					<div class="panel">
						<div class="panel-heading">
							<h2 class="panel-title" id="panelTitle"></h2> 
							<p id="selected-place"></p>
							<a class="btn"id="refresh-list" onclick="initMap();"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
						</div>
						<div class="panel-body" id="panelBody-1"></div>
						<div class="panel-body" id="panelBody-2"></div>
						<div class="panel-body" id="panelBody-3"></div>
					</div>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
		
		
	</div><!-- container -->

@endsection

@section('buttom')
@overwrite



@section('script')
@section('replace-google-map-api')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIgTQnz-ogU8mW_AidCUlYomtlrCDxUGQ&libraries=places&callback=initMap" async defer></script>

@overwrite

<script src="{{ URL::asset('js/uploadmyphoto.js') }}"></script>
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script> --}}
@endsection