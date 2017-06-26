@extends('layouts.master')

@section('title','People')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/people.css') }}">
@endsection

@section('content')
<div class="container">

	<div class="row">
		@if(strtolower(Auth::user()->user) == strtolower($username['username']))
		<div class="col-md-12">
			{{ $username['username'] }}
		</div>
		@else
				
		@endif
		<div class="col-md-12 wrap-user-information">
			<h1>{{ $username['username'] }}</h1>
			<ul>
					@if($username['same'] == 0)
					<li>
						@if($username['record']==0)
							<a href="{{ url('/follow/'.$username['username']) }}">
								follow
							</a>
						@else
							<a href="{{ url('/unfollow/'.$username['username']) }}">
								unfollow
							</a>
						@endif
					</li>
					@endif
				<li>
					{{ $username['post_count'] }} posts
				</li>
				<li>
					<a data-toggle="modal" data-target="#followers_modal">
						{{ $username['follower_count'] }} followers
					</a>
				</li>
				<li>
					<a data-toggle="modal" data-target="#followings_modal">
						{{ $username['following_count'] }} followings
					</a>
				</li>	
			</ul>	
		</div>
		<div class="col-md-12 wrap-post">
			@foreach ($pictures as $i)
				<img src="{{ $i->pic_location }}">
			@endforeach
		</div>

	</div>

	<!-- Modal for follower list -->
	<div class="modal fade" id="followers_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Followers</h4>
	      </div>
	      <div class="modal-body">
	      	<ul>
	      		@foreach ($follower_list as $fw_list)
	      			<li>
	      				{{$fw_list->user}}
	      			</li>
	      		@endforeach
	      	</ul>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal for following list -->
	<div class="modal fade" id="followings_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Followings</h4>
	      </div>
	      <div class="modal-body">
	      	<ul>
	      		@foreach ($following_list as $fwing_list)
	      			<li>
	      				{{$fwing_list->user}}
	      			</li>
	      		@endforeach
	      	</ul>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

</div>


@endsection

@section('script')
@endsection