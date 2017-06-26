@extends('layouts.master')

@section('title','Tag - #'.$select_tag['tag'].' - More')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tag.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top_modified.css') }}">
<style>
.cover-all{
	padding:0px;	

}
.img-layer{
	position: absolute;
	top:0px;
	left:0px;
	width:100%;
	height:100%;

}

.img-tag{
	position: absolute;
	top:35%;
	left:0px;
	width:100%;
	font-size: 25px;
	text-align: center;
	color:white;
	z-index: 10;
}
.img-layer{
	background-color: #000;
	opacity: 0.6;
	z-index: 5;
}

</style>

@endsection
@section('tag-type',' - More')
@section('content')
@include('layouts.top_new')
@include('layouts.tag_navbar2')

<div class="container">


	<div class="row wrap-content">
		
  	<div class="col-md-2" style="height:1px;"></div>
		<div class="col-md-8 wrap-image">

			<div class="img-container">
			@for( $i=0 ; $i<count($tags_more[0]);$i++)
				
				@if(($i%3)==0)
				<div class="row">
				@endif

				<div class="popular-img-wrap col-md-4 col-xs-12">
					
					<span class="glyphicon glyphicon-time" aria-hidden="true"></span>&nbsp;{{ trimCreatedAt($toptags_pictures[$i]->created_at) }}
					<div class="cover-all col-md-12 col-xs-12">
					
					<img class='img-responsive' alt="" src="{{url($toptags_pictures[$i]->pic_location)}}">
					<div class="img-layer"></div>
					<a href='{{url('/tag/'.$tags_more[0][$i]->type)}}'><div class="img-tag ">#{{$tags_more[0][$i]->type}}</div></a>
					
					</div>
				</div>
				
				@if(($i%3)==2)
				</div>
				@endif
			
			@endfor

			</div>

		</div>    
	</div>

</div>



@section('script')
<script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<script src="{{ URL::asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('js/tag.js') }}"></script>
<script>

</script>
@endsection