
@extends('layouts.master')

@section('title','Place Now - Chat')

@section('style')
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top_modified.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/chat.css') }}">
@endsection


@section('content')

@include('layouts.top_new')
@include('layouts.chat_navbar2')
<div class="container">
	<div class="city-info row">
		<div class="col-md-3 col-xs-4 city-info-left">
			@if(is_null($city_follow))
			<div class="follow-status col-md-12 col-xs-12"> Follow </div>
			@else
			<div class="follow-status col-md-12 col-xs-12"> Unfollow </div>
			@endif
			<div class="post-count col-md-4 col-xs-4">Post:{{$this_city->post_count}}</div>
			<div class="follow-count col-md-4 col-xs-4">Follow:{{$this_city->follow_count}}</div>
			<div class="view-count col-md-4 col-xs-4">View:{{$this_city->view_count}}</div>
		</div>

		<div class="col-md-6 col-xs-4 city-info-middle">
			
			
		</div>
		<div class="col-md-3 col-xs-4 city-info-right">

		</div>
	</div>
</div>
	<div id="chat_body">
	<!-- using tabs to show  public / city / user location -->
	<div class="container">

<div class="row">
		<div id="message_container" class="message_box">

			<div id="message_displayarea" class="message_update col-md-12" >
			<!-- display and update message here -->
			@foreach ($messages as $message)
				<div id="message-line" class="row">
					<div class="sender-profile-image-wrapper col-md-1 col-xs-1">
						 <img src="{{ url('/img/profile-image.jpg') }}" alt="" class="img-rounded sender-profile-image">
					</div>
					<div class="user-msg-detail col-md-10 col-xs-10">
							<div id="message-text" class="col-xs-12 col-md-12">{!!$message -> message!!}</div>
							<div id="message-sender" class="col-xs-1 col-md-1"> &nbsp;by &nbsp;
							<a href="{{url('/user/'.App\User::find($message->user_id)->user)}}">{{App\User::find($message->user_id)->user}}
							</a>
							</div>
							<div id="message-time" class="col-xs-1 col-md-1">				
								<div id="center-time">{{trimCreatedAt($message -> created_at)}}</div>
							</div>
					</div>
					<div class="report-section">
						<div>report</div>
					</div>
					
				</div>
			@endforeach
			</div>

		</div>
		</div>
		<div class="row">
		<div class="form-group" id="message_inputgroup">
			<form id="message_input" class="form-inline">
			<div class="col-md-10 col-xs-10">
			<input type="text" class="form-control"  name="message" id="message_input_text" autocomplete="off">
			</div>
			<input type="button" id="message_send" class="btn btn-primary col-xs-2 col-md-2" value="Send" >
			{{-- <input type="hidden"  name="_token" value="{{ csrf_token() }}"> --}}
			<input type="hidden" id="chatroom_num" name="place_id" value="{{$position->city}}">
			<input type="hidden" id="type" name="type" value="city">
			</form>

			</form>
		</div>
		</div>
	
	</div>	
</div>

	<meta name="_token" content="{!! csrf_token() !!}" />
@endsection


@section('script')

@endsection

@section('replace-geolocation')

<script src="{{ URL::asset('js/chat.js') }}"></script>

@overwrite