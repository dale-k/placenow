
@extends('layouts.master')

@section('title','Place Now - welcome')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top_modified.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/city.blade.css') }}">
@endsection



@section('content')
@include('layouts.top_new')

<div class="container wrap-margin">

  <div class="row">

    <div class="col-xs-12 wrap-city-info padding-block hidden-md hidden-lg">
      <div class="city-info border-radius">
        <div class="city-info-inner">
          <h1>{{ $city_ary['city'] }}</h1>
          <div class="wrap-follow-btn">
            @if($city_ary['user_follow_city'] == 'yes')
              <a role="button" href="{{ url('unfollowcity/'.$city_ary['city']) }}">Unfollow</a>
            @elseif (Auth::guest())
              <a role="button" href="{{ url('followcity/'.$city_ary['city']) }}">Follow</a>
            @else
              <a role="button" href="{{ url('followcity/'.$city_ary['city']) }}">Follow</a>
            @endif
          </div>
        
          <div class="wrap-about-city">
            <div class="wrap-follow-city">
              <b>{{ $city_ary['follow_count'] }}</b> followers
            </div>
            <div class="number-of-post">
              <b>{{ $city_ary['post_count'] }}</b> posts
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-sm-8 col-md-4 padding-block padding-remove hidden-lg">
      <div class="city-box border-radius">
        <div class="city-box-inner">
          <span class="glyphicon glyphicon-comment chat" aria-hidden="true"></span>
        </div>
      </div>
    </div>

    @if (count($most_popular))
    <div class="col-xs-12 col-sm-8 col-md-6 wrap-best padding-remove">
      <a href="{{ url('/photo/'.$most_popular[0]['id']) }}" class="wrap-best-img border-radius">
        <img class="img-responsive" alt="Responsive image" src="{{  url($most_popular[0]['pic_location']) }}">
        
        <div class="wrap-best-content">
        
          @if ( $most_popular[0]['title'] != '' )
          <div class="best-content">
            <h3>{{ $most_popular[0]['title'] }}</h3>
          </div>
          @elseif ( $most_popular[0]['comment'] != '' )
          <div class="best-content">
            <p>{{ $most_popular[0]['comment'] }}</p>
          </div>
          @elseif ( count( $most_popular[0]->tag ) != 0 )
          <div class="best-content">
            @foreach ( $most_popular[0]->tag as $mp )
              <a>#{{ $mp->type }}</a>
            @endforeach
          </div>
          @endif
          <p class="best-posted-at">
            @ {{ $most_popular[0]->place->location }}
            By {{ $most_popular[0]->user->user }}, 
            {{ trimCreatedAt($most_popular[0]['created_at']) }}
          </p>

        </div>

      </a>
    </div>
    @endif

    <div class="col-xs-12 col-sm-8 col-md-6 padding-block padding-remove hidden-xs">
      <div class="city-info border-radius">
        <div class="city-info-inner">
          <h1>{{ $city_ary['city'] }}</h1>
          <div class="wrap-follow-btn">
            @if($city_ary['user_follow_city'] == 'yes')
              <a role="button" href="{{ url('unfollowcity/'.$city_ary['city']) }}">Unfollow</a>
            @elseif (Auth::guest())
              <a role="button" href="{{ url('followcity/'.$city_ary['city']) }}">Follow</a>
            @else
              <a role="button" href="{{ url('followcity/'.$city_ary['city']) }}">Follow</a>
            @endif
          </div>
        
          <div class="wrap-about-city">
            <div class="wrap-follow-city">
              <b>{{ $city_ary['follow_count'] }}</b> followers
            </div>
            <div class="number-of-post">
              <b>{{ $city_ary['post_count'] }}</b> posts
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-sm-8 col-md-3 padding-block padding-remove hidden-xs">
      <div class="city-box border-radius">
        <div class="city-box-inner">
          <span class="glyphicon glyphicon-comment chat" aria-hidden="true"></span>
        </div>
      </div>
    </div>

    @if (count($most_popular) > 1 && count($most_popular) < 4)
      @for ( $i = 1; $i < count($most_popular); $i++ )
      <div class="col-xs-12 col-sm-8 col-md-4 wrap-best wrap-best-2 padding-remove">
        <!--<div class="best-title">It's Happening Now</div>-->
        <div class="wrap-best-2-img border-radius">
          <a href="{{ url('/photo/'.$most_popular[$i]['id']) }}">
            <img class="img-responsive" alt="Responsive image" src="{{  url($most_popular[$i]['pic_location']) }}">
          </a>
          <div class="wrap-best-content-2">
            @if ( $most_popular[$i]['title'] != '' )
            <div class="best-content-2">
              <h3>{{ $most_popular[$i]['title'] }}</h3>
            </div>
            @elseif ( $most_popular[$i]['comment'] != '' )
            <div class="best-content-2">
              <p>{{ $most_popular[$i]['comment'] }}</p>
            </div>
            @elseif ( count( $most_popular[$i]->tag ) != 0 )
            <div class="best-content-2">
              @foreach ( $most_popular[$i]->tag as $mp )
                <a>#{{ $mp->type }}</a>
              @endforeach
            </div>
            @endif
            <p class="best-posted-at-2">
              @ <a>{{ $most_popular[$i]->place->location }}</a>, 
              By <a>{{$most_popular[$i]->user->user}}</a>, 
              {{ trimCreatedAt($most_popular[$i]['created_at']) }}
            </p>
          </div>
        </div>
      </div>
      @endfor
    @elseif (count($most_popular) >= 4)
      @for ( $i = 1; $i < 4; $i++ )
      <div class="col-xs-12 col-sm-8 col-md-4 wrap-best wrap-best-2 padding-remove">
        <!--<div class="best-title">It's Happening Now</div>-->
        <div class="wrap-best-2-img border-radius">
          <a href="{{ url('/photo/'.$most_popular[$i]['id']) }}">
            <img class="img-responsive" alt="Responsive image" src="{{  url($most_popular[$i]['pic_location']) }}">
          </a>
          <div class="wrap-best-content-2">
            @if ( $most_popular[$i]['title'] != '' )
            <div class="best-content-2">
              <h3>{{ $most_popular[$i]['title'] }}</h3>
            </div>
            @elseif ( $most_popular[$i]['comment'] != '' )
            <div class="best-content-2">
              <p>{{ $most_popular[$i]['comment'] }}</p>
            </div>
            @elseif ( count( $most_popular[$i]->tag ) != 0 )
            <div class="best-content-2">
              @foreach ( $most_popular[$i]->tag as $mp )
                <a>#{{ $mp->type }}</a>
              @endforeach
            </div>
            @endif
            <p class="best-posted-at-2">
              @ <a>{{ $most_popular[$i]->place->location }}</a>, 
              By <a>{{$most_popular[$i]->user->user}}</a>, 
              {{ trimCreatedAt($most_popular[$i]['created_at']) }}
            </p>
          </div>
        </div>
      </div>
      @endfor
    @endif   


    @for ( $i = 0; $i < count($popular_place); $i++ )
    <div class="col-xs-6 col-sm-8 col-md-6 wrap-place padding-remove">
      <a href="{{url('/place/'.$popular_place[$i]->place->location)}}" class="wrap-place-img border-radius">
        <img class="img-responsive" alt="" src="{{url($popular_place[$i]->pic_location)}}">
        <div>
          <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>&nbsp;
          {{ $popular_place[$i]->place->location }}
        </div>
      </a>
    </div>
    @endfor

    <!-- popular Question -->
    @if (count($popularQuestion)!=0)

    <div class="col-xs-12 col-sm-6 col-md-6 wrap-popular-question padding-remove">

      <div class="pq-title">
        Ask
      </div>

      <a href="{{ url('ask/answers/'.$popularQuestion[0]->question) }}" class="popular-question border-radius">
        <h4 class="pq-question">{{ $popularQuestion[0]->question }}</h4>
      </a>

      <div class="pq-btn">
        <p class="pq-asked-by">
          Asked By 
          <a>{{ $popularQuestion[0]->user->user }}</a>, 
          {{ trimCreatedAt($popularQuestion[0]->created_at) }}<br>
          {{ $popularQuestion[0]->num_answer }} answers
        </p>
      </div>

    </div>

    @endif
    <!-- End - popular Question -->

    <!-- popular tag -->
    @for ( $i = 0; $i < count($popular_tag); $i++ )

      <div class="col-md-3 wrap-tag">
        <a href="{{url('/tag/'.$popular_tag[$i]->type)}}" class="wrap-tag-img tag-3 border-radius">
          <img class="img-responsive" alt="" src="{{url($popular_tag_pic[$i]->pic_location)}}">
          <div>#{{ $popular_tag[$i]->type }} -  {{ $popular_tag[$i]->type_count }} posts</div>
        </a>
      </div>

    @endfor

  </div>    

</div><!-- end of container -->


{{-- <div class="container wrap-popular-place padding-remove">
  <div class="row padding-block">
    @for ( $i = 0; $i < count($popular_place); $i++ )
    <div class="col-xs-6 col-sm-8 col-md-6 wrap-place padding-remove">
      <a href="{{url('/place/'.$popular_place[$i]->place->location)}}" class="wrap-place-img border-radius">
        <img class="img-responsive" alt="" src="{{url($popular_place[$i]->pic_location)}}">
        <div>
          <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>&nbsp;
          {{ $popular_place[$i]->place->location }}
        </div>
      </a>
    </div>
    @endfor
  </div>
</div> --}}

{{-- <div class="container wrap-fluid-tags padding-remove">

  <div class="row">
    @for ( $i = 0; $i < count($popular_tag); $i++ )
      @if ( $i == 0 )
    <div class="col-md-6 wrap-tag">
      <a href="{{url('/tag/'.$popular_tag[$i]->type)}}" class="wrap-tag-img tag-1 border-radius">
        <img class="img-responsive" alt="" src="{{url($popular_tag_pic[$i]->pic_location)}}">
        <div>#{{ $popular_tag[$i]->type }} -  {{ $popular_tag[$i]->type_count }} posts</div>
      </a>
    </div>
      @elseif ( $i == 1 )
    <div class="col-md-6 wrap-tag">
      <a href="{{url('/tag/'.$popular_tag[$i]->type)}}" class="wrap-tag-img tag-2 border-radius">
        <img class="img-responsive" alt="" src="{{url($popular_tag_pic[$i]->pic_location)}}">
        <div>#{{ $popular_tag[$i]->type }} -  {{ $popular_tag[$i]->type_count }} posts</div>
      </a>
    </div>
      @else
    <div class="col-md-3 wrap-tag">
      <a href="{{url('/tag/'.$popular_tag[$i]->type)}}" class="wrap-tag-img tag-3 border-radius">
        <img class="img-responsive" alt="" src="{{url($popular_tag_pic[$i]->pic_location)}}">
        <div>#{{ $popular_tag[$i]->type }} -  {{ $popular_tag[$i]->type_count }} posts</div>
      </a>
    </div>
      @endif


    @endfor
  </div>
</div> --}}

<div class="container padding-remove">

  <div class="row padding-remove">

  </div>

  <div class="row grid">

    <div class="col-xs-12 col-sm-6 col-md-3 grid-sizer"></div>

    @if (count($most_popular) > 4)

    @for ($i = 4; $i < count($most_popular); $i++)
    <div class="col-xs-12 col-sm-6 col-md-3 wrap-nearby grid-item padding-block">

      <div class="nearby border-radius">

        <a href="{{ url('photo/'.$most_popular[$i]->id) }}" class="wrap-nearby-img">
          <img class="img-responsive" alt="Responsive image" src="{{ url($most_popular[$i]->pic_location) }}">
        </a>

        <div class="nearby-content">

          <a class="nearby-location" href="{{ url( 'place/'.$most_popular[$i]->place->location ) }}">
            <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
            {{ $most_popular[$i]->place->location }} ( {{ roundDistance($most_popular[$i]->distance) }} )
          </a>

          @if ( $most_popular[$i]->title != '' )
            <h4>{{ $most_popular[$i]->title }}</h4>
          @endif

          @if ( $most_popular[$i]->comment != '' )
            <p>{{ $most_popular[$i]->comment }}</p>
          @endif

          @if (count($most_popular[$i]->tag)>0)
            <div class="wrap-tags">
            @foreach ($most_popular[$i]->tag as $tag)
              <a href="">#{{ $tag->type }}</a>
            @endforeach
            </div>
          @endif
          <div class="wrap-user-time">
            <div class="nearby-user">By {{ $most_popular[$i]->user->user }},</div> 
            <div class="nearby-when">{{ trimCreatedAt($most_popular[$i]->created_at) }}</div>
          </div>
        </div>

      </div>
    </div>
    @endfor

    @endif

  </div>

</div>

@endsection

@section('script')
<script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<script src="{{ URL::asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('js/welcome.js') }}"></script>
@endsection