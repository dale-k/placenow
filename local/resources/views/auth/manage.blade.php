@if(Auth::user()->email=='admin@admin.admin')
@extends('layouts.master')

@section('title','Place Now Management')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">

@endsection

@section('content')
<div class="container">
<!-- 4 section   picture  user   place   chat -->
	<div class="row">
		<div class="container-inline" id="show_picture">
			Total Photo upload :{{$pictures->count()}}
			<!-- show list of picture  -->

		</div>
		<div class="container-inline" id="show_user">
			Total User registered :{{$users->count()}}
		</div>
	</div>
	<div class="row">
		<div class="container-inline" id="show_place">
			Place recorded : {{$places->count()}}

		</div>
		
	</div>
	<div class="row">
		<div class="container-inline" id="show_chatroom">
			Chatroom avaiable : {{$chatrooms->count()}}

		</div>
	</div>
	<div class="row">
		<div class="container-inline" id="show_chat">
				
		</div>
	</div>
</div>
@endsection

@else
	<script>
        window.location = "/";
    </script>
@endif