
@extends('layouts.master')   

@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
@endsection

@section('script')
<script src="{{ URL::asset('js/main.js') }}"></script>   
@endsection     

@section('content')

    </head>
    <body>
        <div class="container-fluid">

            @include('layouts.top')

            <div class="jumbotron">
              <div class="container">
                <!--
                <h1>Hello, world!</h1>
                <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
                <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>
            -->
              </div>
            </div>

            <div id=""></div>

            <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIgTQnz-ogU8mW_AidCUlYomtlrCDxUGQ&libraries=places&callback=initMap" async defer></script>-->

        </div>


@endsection




