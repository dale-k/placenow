@extends('layouts.master')

@section('title','Pictures')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top_picture_blade.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/picture_blade.css') }}">
@endsection

@section('content')
{{-- @include('layouts.top_picture_blade_test') --}}
<div class="timeline-display">

<div class="container">

	<div class="row wrap-content">
				 <!-- NOW <BR> -->
		       {{-- {{$picture->id}}<br> --}}
				<!-- Before <br> -->
			{{-- @for($i=count($pictures_before)-1; $i>=0;$i--) --}}
				{{-- {{$pictures_before[$i]->id}}&nbsp;{{$pictures_before[$i]->location}}&nbsp;{{$pictures_before[$i]->created_at}}&nbsp;{{$pictures_before[$i]->distance}} --}}
				{{-- &nbsp;{{$pictures_before[$i]->user->user}}<br> --}}
			{{-- <!-- @endfor --> --}}
				<!-- After <br> -->
			{{-- @for( $i=0 ; $i<count( $pictures_after );$i++) --}}
				{{-- {{$pictures_after[$i]->id}}&nbsp;{{$pictures_after[$i]->location}}&nbsp;{{$pictures_after[$i]->created_at}}&nbsp;{{$pictures_after[$i]->distance}}<br> --}}
			{{-- @endfor --}}
			<!-- <br> -->
			<!-- bHistory<br> -->

			{{-- @for( $i=0;$i<count($history_before);$i++) --}}
				{{-- {{$history_before[$i]->picture_id}}&nbsp;{{$history_before[$i]->user_id}} <br> --}}
			{{-- @endfor			 --}}
			<!-- aHistory <br> -->
			{{-- @foreach( $history_after as $hafter) --}}
				{{-- {{$hafter->picture_id}}&nbsp;{{$hafter->user_id}} <br> --}}

			{{-- @endforeach --}}
		
			<!-- Follow list before<br> -->
			{{-- @for ($i=0;$i<count($followlist_before);$i++) --}}
				{{-- {{$followlist_before[$i]}}<br> --}}
			{{-- @endfor --}}


			{{-- @for($i=0; $i<count($userids_before);$i++) --}}
				{{-- {{$userids_before[$i]}}<br> --}}
			{{-- @endfor --}}

<!-- Start of pictures before  -->
	


@for($i = count($pictures_before)-1 ; $i >=0 ;$i--)
			
			<div class="wrap-image row">
			
			<div class="img-before-{{$i}} each-img @if($i==count($pictures_before)-1){{'first-img'}}@endif">
			<div id="img-location-info row">
				<h1 class="picture-title col-md-12"><a href="{{ url('place/'.$pictures_before[$i]->place->location) }}">{{$pictures_before[$i]->place->location}} </a></h1>
				<div class="col-md-8">
					<ol class="breadcrumb wrap-pic-location">
						<li><a href="{{ url('city/'.$pictures_before[$i]->place->city) }}"> {{$pictures_before[$i]->place->city}} </a></li>
						<li><a href="{{ url('state/'.$pictures_before[$i]->place->state) }}"> {{$pictures_before[$i]->place->state}} </a></li>
						<li><a href="{{ url('country/'.$pictures_before[$i]->place->country) }}"> {{$pictures_before[$i]->place->country}}</a></li>
					</ol>
				</div>
			</div>
					
				<div class="col-md-8 col-xs-12 no-padding">
				<div id="uploaded-time" class="col-md-12"><span class="glyphicon glyphicon-time" aria-hidden="true"></span>{{trimCreatedAt($pictures_before[$i]->created_at)}}</div>
					<img class="col-md-12 shown img-hidden" alt="Responsive image" src=" {{ url($pictures_before[$i]->pic_location) }}">
					<div id="mid_section" class="col-md-12 col-xs-12">
					
						<div id="tag_list" class="col-md-4">
						
							@foreach($pictures_before[$i]->tag as $tag)
							<a href="{{url('tag/'.$tag->type)}}"> #{{$tag->type}} </a>&nbsp;&nbsp;&nbsp;
							@endforeach
						</div>
						<div id ="pic_btns" >
							@if($history_before[$i]->voted)
								<button type="button" id="vote_btn" class="btn btn-default" onclick="postVote('0','{{ Crypt::encrypt($pictures_before[$i]->id) }}');" disabled>
					            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>&nbsp;{{$pictures_before[$i]->vote_count}}
					        </button>
							@else
								<button type="button" id="vote_btn" class="btn btn-default" onclick="postVote('0','{{ Crypt::encrypt($pictures_before[$i]->id) }}');">
					            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>&nbsp;{{$pictures_before[$i]->vote_count}}
					        </button>
							@endif
								
							@if($history_before[$i]->favored)
								<button type="button" id="favor_btn" class="btn btn-default" onclick="postVote('1','{{ Crypt::encrypt($pictures_before[$i]->id) }}');" disabled>
					            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;{{$pictures_before[$i]->favor_count}}
					        </button>
							@else
								<button type="button" id="favor_btn" class="btn btn-default" onclick="postVote('1','{{ Crypt::encrypt($pictures_before[$i]->id) }}');">
					            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;{{$pictures_before[$i]->favor_count}}
					        </button>
							@endif

							@if($history_before[$i]->recommended)
								<button type="button" id="recommend_btn" class="btn btn-default" onclick="postVote('2','{{ Crypt::encrypt($pictures_before[$i]->id) }}');" disabled>
					            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;{{$pictures_before[$i]->recommend_count}}
					        </button>
							@else
								<button type="button"  id="recommend_btn" class="btn btn-default" onclick="postVote('2','{{ Crypt::encrypt($pictures_before[$i]->id) }}');">
					            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;{{$pictures_before[$i]->recommend_count}}
					        </button>
							@endif
					    </div>  <!-- end of pic btn	 -->
					</div>  <!-- end of mid section -->
				</div> <!-- end of left side  img and tag and btns   -->
				

				<div class="wrap-user-information col-md-4 col-xs-12 comment_section">
				<div class="picInfo-wrapp">
					<div class="media">
					  <div class="media-left">
					    <a href="#">
					      <img src="{{ url('/img/profile-image.jpg') }}" alt="" class="media-object img-circle uploader-profile-image">
					    </a>
					  </div>
					  <div class="media-body">
					    <h4 class="media-heading">
							<a class ="author" href="{{ url('/people/'.$pictures_before[$i]->user->user) }}">{{ $pictures_before[$i]->user->user }}</a>
							<ul>
								@if($followlist_before[$i] > 0)
								<li>
									@if($followlist_before[$i] ==0)
										<a href="{{ url('/follow/'.$pictures_before[$i]->user->user) }}">
								    	follow
										</a>
									@else
										<a href="{{ url('/unfollow/'.$pictures_before[$i]->user->user) }}">
										unfollow
										</a>
									@endif
								</li>
								@endif
							</ul>
					    </h4>
					    
					    <div class="pic_comment no-padding"> {{ $pictures_before[$i]->comment }}</div>
					    
					  </div>
					</div>
		         

		        </div>	
				</div>
			</div>
			</div>
@endfor	



<!-- End of pictures before    -->


			<div class="img-now each-img show-img">
			
			<div class="wrap-image row now">
				<div id="img-location-info">
			<h1 class="picture-title"><a href="{{ url('place/'.$picture->place->location) }}">@ {{$picture->place->location}} </a></h1>
			<div class="">
				<ol class="breadcrumb wrap-pic-location">
					<li><a href="{{ url('city/'.$picture->place->city) }}"> {{$picture->place->city}} </a></li>
					<li><a href="{{ url('state/'.$picture->place->state) }}"> {{$picture->place->state}} </a></li>
					<li><a href="{{ url('country/'.$picture->place->country) }}"> {{$picture->place->country}}</a></li>
				</ol>
			</div>
			</div>
				<div id="uploaded-time" class="col-md-12">
						{{trimCreatedAt($picture->created_at)}}
					</div>
				<div class="col-md-8 col-xs-12 no-padding">
				<div class="col-md-12 col-xs-12 img-resizer">
				<img class="shown image-now img-hidden" alt="Responsive image" src=" {{ url($picture->pic_location) }}">
				</div>
				<div id="mid_section" class="col-md-12">
				
				<div id="tag_list" class="col-md-4">
					@foreach($tags as $tag)
					<a href="{{url('tag/'.$tag->type)}}"> #{{$tag->type}} </a>&nbsp;&nbsp;&nbsp;
					@endforeach
				</div>
				<div id ="pic_btns" >
					@if($voteHistory->voted)
						<button type="button" id="vote_btn" class="btn btn-default" onclick="postVote('0','{{ Crypt::encrypt($picture->id) }}');" disabled>
			            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>&nbsp;{{$picture->vote_count}}
			        </button>
					@else
						<button type="button" id="vote_btn" class="btn btn-default" onclick="postVote('0','{{ Crypt::encrypt($picture->id) }}');">
			            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>&nbsp;{{$picture->vote_count}}
			        </button>
					@endif
						
					@if($voteHistory->favored)
						<button type="button" id="favor_btn" class="btn btn-default" onclick="postVote('1','{{ Crypt::encrypt($picture->id) }}');" disabled>
			            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;{{$picture->favor_count}}
			        </button>
					@else
						<button type="button" id="favor_btn" class="btn btn-default" onclick="postVote('1','{{ Crypt::encrypt($picture->id) }}');">
			            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;{{$picture->favor_count}}
			        </button>
					@endif

					@if($voteHistory->recommended)
						<button type="button" id="recommend_btn" class="btn btn-default" onclick="postVote('2','{{ Crypt::encrypt($picture->id) }}');" disabled>
			            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;{{$picture->recommend_count}}
			        </button>
					@else
						<button type="button"  id="recommend_btn" class="btn btn-default" onclick="postVote('2','{{ Crypt::encrypt($picture->id) }}');">
			            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;{{$picture->recommend_count}}
			        </button>
					@endif
			    </div>
				</div>
				</div>
				<div class="wrap-user-information col-md-4 col-xs-12 comment_section">
				<div class="picInfo-wrapp">
					<div class="media">
					  <div class="media-left">
					    <a href="#">
					      <img src="{{ url('/img/profile-image.jpg') }}" alt="" class="media-object img-circle uploader-profile-image">
					    </a>
					  </div>
					  <div class="media-body">
					    <h4 class="media-heading">
							<a class ="author" href="{{ url('/people/'.$picture->user->user) }}">{{ $picture->user->user }}</a>
							<ul>
								@if($ch_follow > 0)
								<li>
									@if($ch_follow ==0)
										<a href="{{ url('/follow/'.$picture->user->user) }}">
										follow
										</a>
									@else
										<a href="{{ url('/unfollow/'.$picture->user->user) }}">
											unfollow
										</a>
									@endif
								</li>
								@endif
							</ul>
					    </h4>
					    <div class="pic_comment no-padding"> {{ $picture->comment }}</div>
					    
					  </div>
					</div>
		         

		        </div>	
				</div>
			</div>
			</div>
<!--start of pictures after  -->
			




@for($j = 0 ; $j < count($pictures_after) ;$j++)
			<div class="img-after-{{$j}} each-img hidden-img @if($j==(count($pictures_after)-1)){{'last-img'}}@endif">
			
			<div class="wrap-image row">
			<div id="img-location-info">
				<h1 class="picture-title"><a href="{{ url('place/'.$pictures_after[$j]->place->location) }}">{{$pictures_after[$j]->place->location}} </a></h1>
				<div class="">
					<ol class="breadcrumb wrap-pic-location">
						<li><a href="{{ url('city/'.$pictures_after[$j]->place->city) }}"> {{$pictures_after[$j]->place->city}} </a></li>
						<li><a href="{{ url('state/'.$pictures_after[$j]->place->state) }}"> {{$pictures_after[$j]->place->state}} </a></li>
						<li><a href="{{ url('country/'.$pictures_after[$j]->place->country) }}"> {{$pictures_after[$j]->place->country}}</a></li>
					</ol>
				</div>
			</div>
				<div id="uploaded-time" class="col-md-12">
					{{trimCreatedAt($pictures_after[$j]->created_at)}}
				</div>
				<div class="col-md-8 no-padding">
				<img class="col-md-12 shown img-hidden" alt="Responsive image" src=" {{ url($pictures_after[$j]->pic_location) }}">
				<div id="mid_section" class="col-md-12">
				
				<div id="tag_list" class="col-md-4">
				
					@foreach($pictures_after[$j]->tag as $tag)
					<a href="{{url('tag/'.$tag->type)}}"> #{{$tag->type}} </a>&nbsp;&nbsp;&nbsp;
					@endforeach
				</div>
				<div id ="pic_btns" >
					@if($history_after[$j]->voted)
						<button type="button" id="vote_btn" class="btn btn-default" onclick="postVote('0','{{ Crypt::encrypt($pictures_after[$j]->id) }}');" disabled>
			            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>&nbsp;{{$pictures_after[$j]->vote_count}}
			        </button>
					@else
						<button type="button" id="vote_btn" class="btn btn-default" onclick="postVote('0','{{ Crypt::encrypt($pictures_after[$j]->id) }}');">
			            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>&nbsp;{{$pictures_after[$j]->vote_count}}
			        </button>
					@endif
						
					@if($history_after[$j]->favored)
						<button type="button" id="favor_btn" class="btn btn-default" onclick="postVote('1','{{ Crypt::encrypt($pictures_after[$j]->id) }}');" disabled>
			            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;{{$pictures_after[$j]->favor_count}}
			        </button>
					@else
						<button type="button" id="favor_btn" class="btn btn-default" onclick="postVote('1','{{ Crypt::encrypt($pictures_after[$j]->id) }}');">
			            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;{{$pictures_after[$j]->favor_count}}
			        </button>
					@endif

					@if($history_after[$j]->recommended)
						<button type="button" id="recommend_btn" class="btn btn-default" onclick="postVote('2','{{ Crypt::encrypt($pictures_after[$j]->id) }}');" disabled>
			            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;{{$pictures_after[$j]->recommend_count}}
			        </button>
					@else
						<button type="button"  id="recommend_btn" class="btn btn-default" onclick="postVote('2','{{ Crypt::encrypt($pictures_after[$j]->id) }}');">
			            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;{{$pictures_after[$j]->recommend_count}}
			        </button>
					@endif
			    </div>
				</div>
				</div>
				<div class="wrap-user-information col-md-4 comment_section">
				<div class="picInfo-wrapp">
					<div class="media">
					  <div class="media-left">
					    <a href="#">
					      <img src="{{ url('/img/profile-image.jpg') }}" alt="" class="media-object img-circle uploader-profile-image">
					    </a>
					  </div>
					  <div class="media-body">
					    <h4 class="media-heading">
							<a class ="author" href="{{ url('/people/'.$pictures_after[$j]->user->user) }}">{{ $pictures_after[$j]->user->user }}</a>
							<ul>
								@if($followlist_after[$j] > 0)
								<li>
									@if($followlist_after[$j]==0)
										<a href="{{ url('/follow/'.$pictures_before[$j]->user->user) }}">
										<!-- follow -->
										</a>
									@else
										<a href="{{ url('/unfollow/'.$pictures_before[$j]->user->user) }}">
										unfollow
										</a>
									@endif
								</li>
								@endif
							</ul>
					    </h4>
					    <div class="pic_comment no-padding"> {{ $pictures_after[$j]->comment }}</div>
					    
					  </div>
					</div>
		         

		        </div>	
				</div>
			</div>
			
			</div>
@endfor

<!-- end of pictures after -->

			{{-- <!-- <button type="button" class="btn btn-primary btn-loadbefore"> @if(count($pictures_before)==0){{"Load More"}}@else{{'Load Before'}} @endif  </button>  --> --}}
			{{-- <!-- <button type="button" class="btn btn-primary btn-loadafter">@if(count($pictures_after)==0){{"Load More"}}@else{{'Load After'}} @endif </button> 	 --> --}}
			
	</div>


   
	

</div>

	<!-- <div id='timelime-right' style="height:770px;"> -->
		<!-- <div id="moving-point"></div> -->
	 {{-- @for($i=0;$i<$num_of_photos;$i++) --}}
	    {{-- <div id='time-point' style="top:{{ ((770/$num_of_photos)*$i+20)."px;"}}"></div> --}}
	 {{-- @endfor --}}
	<!-- </div> -->

</div> <!-- end of timeline display -->


<script>
	
</script>
@endsection

@section('script')
<script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<script src="{{ URL::asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('js/picture_blade.js') }}"></script>
@endsection