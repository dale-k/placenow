@if(Auth::guest())
    
    <script>
        window.location = "/login";
    </script>

@else

@extends('layouts.master')

@section('title','Place Now - Your Profile')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
<style>
    .grid-sizer,
      .grid-item {
        /*width: 33.333%;*/
      }

      .grid-item {
        float: left;
      }

      .grid-item img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
      }
      .grid-item div {
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 5%;
        width: 95%;
      }

      .col-xs-12 {
        padding: 0 !important;
      }

      /* Medium devices (desktops, 992px and up) */
      @media (min-width: 992px) {
        .grid-item img {
          width: 95% !important;
        }
      }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div id="pre_post" class="panel-heading">
                    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapse_post" aria-expanded="false" aria-controls="collapse_post">
                         Previous Post
                    </a>
                </div>
                    <!-- show all user post -->
                    <div class="collapse" id="collapse_post">
                    <div class="container-fluid">
                      <div class="row grid">
                        @foreach ( $pictures as $picture )
                        <div class="grid-item col-xs-12 col-sm-8 col-md-4">
                            Uploaded at {{$picture->created_at}}
                            <img class="" src="{{ $picture->pic_location }}">
                            <div>
                              <div class="pic_title">{{$picture->place->country}} , {{$picture->place->state}} , 
                              {{$picture->place->city}} @ {{$picture->place->location}}</div>
                              <div class="pic_comment">{{ $picture->comment }}</div>
                              <div class="pic_btn">
                                <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>&nbsp;{{$picture->vote_count}}
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;{{$picture->favor_count}}
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;{{$picture->recommend_count}}
                              </div>
                            </div>
                        </div>
                        @endforeach

                       </div>

                      </div>
                      </div>
                    <div id="fav_place" class="panel-heading">
                        <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapse_place" aria-expanded="false" aria-controls="collapse_place">
                             Favorite Place
                        </a>
                    </div>
                    <div class="collapse" id="collapse_place">
                            Favorite Place
                    </div>
                    <div id="fav_photo" class="panel-heading">
                        <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapse_photo" aria-expanded="false" aria-controls="collapse_photo">
                                 Favorite Photo
                        </a>
                    </div>
                   <div class="collapse" id="collapse_photo">
                                 Favorite Photo
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@endif