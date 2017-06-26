
@extends('layouts.master')

@section('title','Place Now - welcome')

@section('style')
  {{-- <link href='https://fonts.googleapis.com/css?family=PT+Sans:700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Berkshire+Swash' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Permanent+Marker' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'> --}}
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top_modified.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/welcome2.blade.css') }}">
@endsection

@section('content')

@include('layouts.top_new')



<div class="container wrap-margin">

  <div class="row padding-remove">

    {{-- <div class="col-xs-12 col-sm-6 col-md-3 grid-sizer"></div> --}}

    

    

    @if (count($most_popular))

    <div class="col-xs-12 col-sm-6 col-md-6 wrap-most-popular padding-around">

      @if ($most_popular[0]->photo != 'text')
      <a href="{{url('photo/'.$most_popular[0]->id)}}" class="wrap-img mmp-1 block-border-radius">
        <img class="img-responsive" alt="" src="{{ createDataURL($most_popular[0]->pic_location) }}">
      </a>
      @endif

      <div class="wrap-mmp-content-1">
        
        @if ( $most_popular[0]->title != '' )
          <div class="mmp-content-1">
            <h3>{{ $most_popular[0]->title }}</h3>
          </div>
        @elseif ( $most_popular[0]['comment'] != '' )
          <div class="mmp-content-1">
            <p>{{ $most_popular[0]['comment'] }}</p>
          </div>
        @elseif ( count( $most_popular[0]->tag ) != 0 )
          <div class="mmp-content-1">
            @foreach ( $most_popular[0]->tag as $mp )
              <a href="" class="comment-tag">#{{ $mp->type }}</a>
            @endforeach
          </div>
        @endif

        <div class="mmp-posted-by mmpp-1">

          <a href="{{ url('place/'.$most_popular[0]->place->id) }}" class="mmp-location mmpl-1">  
            @ {{ $most_popular[0]->place->location }} . 
          </a>

          <a href="url('use/'.$most_popular[0]->user->user ) }}">
            By {{ $most_popular[0]->user->user }}, 
            {{ trimCreatedAt($most_popular[0]->created_at) }}
          </a>

        </div>

      </div>

    </div>

    @endif

    @if (count($most_popular) > 1)
    <div class="col-xs-12 col-sm-6 col-md-3 padding-remove">
    @for ($i = 1; $i < 2; $i++)

      <div class="col-xs-12 col-sm-6 col-md-12 wrap-most-popular padding-around">

        <a href="{{url('photo/'.$most_popular[$i]->id)}}" class="wrap-img mmp-2 block-border-radius">
          @if ($most_popular[$i]->photo != 'text')
          <img class="img-responsive" alt="" src="{{ createDataURL($most_popular[$i]->pic_location) }}">
          @endif
        </a>

        <div class="wrap-mmp-content-2">
          
          @if ( $most_popular[$i]->title != '' )
            <div class="mmp-content-2">
              <h3>{{ $most_popular[$i]->title }}</h3>
            </div>
          @elseif ( $most_popular[$i]['comment'] != '' )
            <div class="mmp-content-2">
              <p>{{ $most_popular[$i]['comment'] }}</p>
            </div>
          @elseif ( count( $most_popular[$i]->tag ) != 0 )
            <div class="mmp-content-2">
              @foreach ( $most_popular[$i]->tag as $mp )
                <a href="" class="comment-tag">#{{ $mp->type }}</a>
              @endforeach
            </div>
          @endif

          <div class="mmp-posted-by mmpp-2">

            <a href="{{ url('place/'.$most_popular[$i]->place->id) }}" class="mmp-location mmpl-2">  
              @ {{ $most_popular[$i]->place->location }} . 
            </a>

            <a href="url('use/'.$most_popular[$i]->user->user ) }}">
              By {{ $most_popular[$i]->user->user }}, 
              {{ trimCreatedAt($most_popular[$i]->created_at) }}
            </a>

          </div>

        </div>

      </div>

    @endfor
    </div>
    @endif

    @if (count($most_popular) > 3 )
        <div class="col-xs-12 col-sm-6 col-md-3 padding-remove">
    @for ($i = 2; $i < 4; $i++)

      <div class="col-xs-12 col-sm-6 col-md-12 wrap-most-popular padding-around">

        @if ($most_popular[$i]->photo != 'text')
        <a href="{{url('photo/'.$most_popular[$i]->id)}}" class="wrap-img mmp-3 block-border-radius">
          <img class="img-responsive" alt="" src="{{ createDataURL($most_popular[$i]->pic_location) }}">
        </a>
        @endif

        <div class="wrap-mmp-content-2">
          
          @if ( $most_popular[$i]->title != '' )
            <div class="mmp-content-2">
              <h3>{{ $most_popular[$i]->title }}</h3>
            </div>
          @elseif ( $most_popular[$i]['comment'] != '' )
            <div class="mmp-content-2">
              <p>{{ $most_popular[$i]['comment'] }}</p>
            </div>
          @elseif ( count( $most_popular[$i]->tag ) != 0 )
            <div class="mmp-content-2">
              @foreach ( $most_popular[$i]->tag as $mp )
                <a href="" class="comment-tag">#{{ $mp->type }}</a>
              @endforeach
            </div>
          @endif

          <div class="mmp-posted-by mmpp-2">

            <a href="{{ url('place/'.$most_popular[$i]->place->id) }}" class="mmp-location mmpl-2">  
              @ {{ $most_popular[$i]->place->location }} . 
            </a>

            <a href="url('use/'.$most_popular[$i]->user->user ) }}">
              By {{ $most_popular[$i]->user->user }}, 
              {{ trimCreatedAt($most_popular[$i]->created_at) }}
            </a>

          </div>

        </div>

      </div>

    @endfor
    </div>
    @endif

  </div>
</div>



<div class="container wrap-popular-place-container">

  <div class="row padding-remove">

    <!-- popular places -->
    @if (count($popular_place))
    <div class="col-xs-6 col-sm-12 col-md-3 wrap-popular-places-title padding-around">


      <h4 class="mpp-title block-border-radius">
        Popular Places
      </h4>


    </div>

    @for ( $i = 0; $i < count($popular_place); $i++ )
    <div class="col-xs-6 col-sm-12 col-md-3 wrap-popular-places padding-around">

      <a href="{{ url('place/'.$popular_place[$i]->place->location ) }}" class="wrap-img block-border-radius">

        @if ($popular_place[$i]->photo != 'text')
        <img class="img-responsive" alt="" src="{{ createDataURL($popular_place[$i]->pic_location) }}">
        @endif

        <h4 class="mpp-place">
          &nbsp;
          {{ $popular_place[$i]->place->location }}
        </h4>

      </a>

    </div>
    @endfor

    @endif
    <!-- End - popular places -->




    



  </div><!-- end of first row -->

</div>


<!-- start container -->
<div class="container wrap-popular-tag-container">
  <div class="row padding-remove">

    <!-- Popular Tag -->
    @for ( $pt = 0; $pt < count($popular_tag); $pt++ )
    <div class="col-xs-12 col-sm-6 col-md-3 wrap-popular-tags padding-remove">

      <div class="pt-title">
        Tag
      </div>

      <a class="pt-tag block-border-radius" href="{{ url('tag/'.$popular_tag[$pt]->type) }}">
        #{{ $popular_tag[$pt]->type }}
      </a>

      <div class="pt-bt">
        {{ $popular_tag[$pt]->type_count }} posts
      </div>

    </div>
    @endfor

  </div>
</div>
<!-- end container -->

<!-- start container -->
<div class="container wrap-popular-question-container">
  <div class="row padding-remove">

    <!-- popular Question -->
    @for ($pq = 0; $pq < count($popularQuestion); $pq++)

    <div class="col-xs-12 col-sm-6 col-md-3 grid-item wrap-popular-question padding-remove">
      
      <div class="pq-title">
        Ask
      </div>

      <a href="{{ url('ask/answers/'.$popularQuestion[0]->question) }}" class="popular-question block-border-radius">
        <h4 class="pq-question">{{ $popularQuestion[$pq]->question }}</h4>
      </a>

      <div class="pq-btn">
        <div class="pq-asked-by">
          Asked By 
          <a>{{ $popularQuestion[$pq]->user->user }}</a>, 
          {{ trimCreatedAt($popularQuestion[$pq]->created_at) }}
        </div>
      </div>

    </div>

    @endfor
    <!-- End - popular Question -->

  </div>
</div>
<!-- end container -->


<!-- start container -->
<div class="container wrap-most-popular-container">

  <div class="row grid padding-remove">

    <div class="col-xs-12 col-sm-6 col-md-4 grid-sizer"></div>

      @if (count($most_popular) > 1)

      @for ($i = 2; $i < count($most_popular); $i++)

      <div class="col-xs-12 col-sm-6 col-md-4 grid-item wrap-most-popular padding-around">

        @if ($most_popular[$i]->photo != 'text')
        <a href="{{url('photo/'.$most_popular[$i]->id)}}" class="wrap-img mmp-3 block-border-radius">
          <img class="img-responsive" alt="" src="{{ $most_popular[$i]->pic_location }}">
        </a>
        @endif

        <div class="wrap-mmp-content-2">
          
          @if ( $most_popular[$i]->title != '' )
            <div class="mmp-content-2">
              <h3>{{ $most_popular[$i]->title }}</h3>
            </div>
          @elseif ( $most_popular[$i]['comment'] != '' )
            <div class="mmp-content-2">
              <p>{{ $most_popular[$i]['comment'] }}</p>
            </div>
          @elseif ( count( $most_popular[$i]->tag ) != 0 )
            <div class="mmp-content-2">
              @foreach ( $most_popular[$i]->tag as $mp )
                <a href="" class="comment-tag">#{{ $mp->type }}</a>
              @endforeach
            </div>
          @endif

          <div class="mmp-posted-by mmpp-2">

            <a href="{{ url('place/'.$most_popular[$i]->place->id) }}" class="mmp-location mmpl-2">  
              @ {{ $most_popular[$i]->place->location }}
            </a>
   
            By 

            <a href="url('use/'.$most_popular[$i]->user->user ) }}">
              {{ $most_popular[$i]->user->user }}
            </a>, 
            {{ trimCreatedAt($most_popular[$i]->created_at) }}

          </div>

        </div>

      </div>

      @if ( $i%8 == 0)

        <!-- Popular Tag -->
        {{-- <div class="col-xs-12 col-sm-6 col-md-4 grid-item wrap-popular-tags padding-remove">

          <div class="pt-title">
            Popular Tag
          </div>

          <a class="pt-tag block-border-radius" href="{{ url('tag/'.$popular_tag[$j]->type) }}">
            #{{ $popular_tag[$j]->type }}
          </a>

          <div class="pt-bt">
            {{ $popular_tag[$j]->type_count }} posts
          </div>

            <input type="hidden" content="{{ $popular_tag[$j++] }}">
        </div> --}}

      @endif

      @endfor

      @endif

  </div>

</div>
<!-- end container -->

@endsection

@section('script')
<script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<script src="{{ URL::asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('js/welcome.js') }}"></script>
@endsection