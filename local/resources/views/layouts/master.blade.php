<!DOCTYPE html>
<html>
    <head>
    	<title>@yield('title')</title>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta id="token" name="token" content="{{ csrf_token() }}">

    	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap.min.css') }}">
    	{{-- <link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'> --}}
    	{{-- <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> --}}
    	<!-- <link href='https://fonts.googleapis.com/css?family=Voltaire' rel='stylesheet' type='text/css'> -->
    	<!-- <link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'> -->
    	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/master.css') }}">
    	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/top.css') }}">
    	<script type="text/javascript" src="{{ URL::asset('js/jquery.1.11.3.js') }}"></script>
    	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
    	<style>
    	/* latin */
		@font-face {
		  font-family: 'Voltaire';
		  font-style: normal;
		  font-weight: 400;
		  src: local('Voltaire'), url(https://fonts.gstatic.com/s/voltaire/v6/Bcdym-dNGztfenGzlRsZ3_esZW2xOQ-xsNqO47m55DA.woff2) format('woff2');
		  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
		}
		/* cyrillic-ext */
		@font-face {
		  font-family: 'PT Sans Narrow';
		  font-style: normal;
		  font-weight: 400;
		  src: local('PT Sans Narrow'), local('PTSans-Narrow'), url(https://fonts.gstatic.com/s/ptsansnarrow/v7/UyYrYy3ltEffJV9QueSi4SppsHecKHw584ktcwPXSnc.woff2) format('woff2');
		  unicode-range: U+0460-052F, U+20B4, U+2DE0-2DFF, U+A640-A69F;
		}
		/* cyrillic */
		@font-face {
		  font-family: 'PT Sans Narrow';
		  font-style: normal;
		  font-weight: 400;
		  src: local('PT Sans Narrow'), local('PTSans-Narrow'), url(https://fonts.gstatic.com/s/ptsansnarrow/v7/UyYrYy3ltEffJV9QueSi4Uvi3q9-zTdQoLrequQTguk.woff2) format('woff2');
		  unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
		}
		/* latin-ext */
		@font-face {
		  font-family: 'PT Sans Narrow';
		  font-style: normal;
		  font-weight: 400;
		  src: local('PT Sans Narrow'), local('PTSans-Narrow'), url(https://fonts.gstatic.com/s/ptsansnarrow/v7/UyYrYy3ltEffJV9QueSi4T3sPXe5Q4a3bCZMR7ryN4o.woff2) format('woff2');
		  unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
		}
		/* latin */
		@font-face {
		  font-family: 'PT Sans Narrow';
		  font-style: normal;
		  font-weight: 400;
		  src: local('PT Sans Narrow'), local('PTSans-Narrow'), url(https://fonts.gstatic.com/s/ptsansnarrow/v7/UyYrYy3ltEffJV9QueSi4UU-p1xzoRgkupcXIqgYFBc.woff2) format('woff2');
		  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
		}
		/* cyrillic-ext */
		@font-face {
		  font-family: 'PT Sans Narrow';
		  font-style: normal;
		  font-weight: 700;
		  src: local('PT Sans Narrow Bold'), local('PTSans-NarrowBold'), url(https://fonts.gstatic.com/s/ptsansnarrow/v7/Q_pTky3Sc3ubRibGToTAYryh_4Vx_7RIyhQ3vqTJYis.woff2) format('woff2');
		  unicode-range: U+0460-052F, U+20B4, U+2DE0-2DFF, U+A640-A69F;
		}
		/* cyrillic */
		@font-face {
		  font-family: 'PT Sans Narrow';
		  font-style: normal;
		  font-weight: 700;
		  src: local('PT Sans Narrow Bold'), local('PTSans-NarrowBold'), url(https://fonts.gstatic.com/s/ptsansnarrow/v7/Q_pTky3Sc3ubRibGToTAYuICWD8dS1fawAsHP3zkW40.woff2) format('woff2');
		  unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
		}
		/* latin-ext */
		@font-face {
		  font-family: 'PT Sans Narrow';
		  font-style: normal;
		  font-weight: 700;
		  src: local('PT Sans Narrow Bold'), local('PTSans-NarrowBold'), url(https://fonts.gstatic.com/s/ptsansnarrow/v7/Q_pTky3Sc3ubRibGToTAYmwfvudCZ8RknLCBmdpmlzc.woff2) format('woff2');
		  unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
		}
		/* latin */
		@font-face {
		  font-family: 'PT Sans Narrow';
		  font-style: normal;
		  font-weight: 700;
		  src: local('PT Sans Narrow Bold'), local('PTSans-NarrowBold'), url(https://fonts.gstatic.com/s/ptsansnarrow/v7/Q_pTky3Sc3ubRibGToTAYhKUK2vxztsQZZBkxIuj92o.woff2) format('woff2');
		  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
		}

		/* vietnamese */
		@font-face {
		  font-family: 'Source Sans Pro';
		  font-style: normal;
		  font-weight: 400;
		  src: local('Source Sans Pro'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v9/ODelI1aHBYDBqgeIAH2zlNOAHFN6BivSraYkjhveRHY.woff2) format('woff2');
		  unicode-range: U+0102-0103, U+1EA0-1EF9, U+20AB;
		}
		/* latin-ext */
		@font-face {
		  font-family: 'Source Sans Pro';
		  font-style: normal;
		  font-weight: 400;
		  src: local('Source Sans Pro'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v9/ODelI1aHBYDBqgeIAH2zlC2Q8seG17bfDXYR_jUsrzg.woff2) format('woff2');
		  unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
		}
		/* latin */
		@font-face {
		  font-family: 'Source Sans Pro';
		  font-style: normal;
		  font-weight: 400;
		  src: local('Source Sans Pro'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v9/ODelI1aHBYDBqgeIAH2zlNV_2ngZ8dMf8fLgjYEouxg.woff2) format('woff2');
		  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
		}

    	</style>
    	@yield('style')	


    	{{-- <span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=1ygLy5XQqFnqYDkSmehMqDEbvUgWAWd4qP0theoJvWiTlQarsUk1Jewk5z0c"></script></span> --}}
	
	</head>
	
	<body>
		
		
		@yield('content')	

		@section('bottom')
		@include('layouts.bottom')
		@show


		
		
	
	
		<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

		@section('replace-google-map-api')
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIgTQnz-ogU8mW_AidCUlYomtlrCDxUGQ&libraries=places" async defer></script>
		@show

		@section('replace-geolocation')
		<script type="text/javascript" src="{{ URL::asset('js/placenow_geolocation.js') }}"></script>
		@show

		<script type="text/javascript" src="{{ URL::asset('js/top.js') }}"></script>
		<script src="{{ URL::asset('js/placenow_ajax.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/Session.js') }}"></script>
		
		@yield('script')

	</body>

		

</html>	


