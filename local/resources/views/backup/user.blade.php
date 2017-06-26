@extends('layouts.master')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/signin.css') }}">
@endsection  

@section('content')

	    <div class="container-fluid">
	    @include('layouts.top')
		    <div class="container">
@if($goto=="register")

			<form class="form-signin" method="POST" action="/register">
		        <h2 class="form-signin-heading">Registration</h2>
		        <label for="inputUsername" class="sr-only">Email address</label>
		        <input type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
		        <label for="inputEmail" class="sr-only">Email address</label>
		        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required>
		        <label for="inputPassword" class="sr-only">Password</label>
		        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
		        <label for="inputTelephone" class="sr-only">Telephone</label>
		        <input type="tel" id="inputTelephone" class="form-control" placeholder="Telephone Number" required>
		        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
		     </form>


@elseif($goto=="login")
    
		    
			<form class="form-signin">
		        <h2 class="form-signin-heading">Please sign in</h2>
		        <label for="inputEmail" class="sr-only">Email address</label>
		        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
		        <label for="inputPassword" class="sr-only">Password</label>
		        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
		        <div class="checkbox">
		          <label>
		            <input type="checkbox" value="remember-me"> Remember me
		          </label>
		        </div>
		        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			</form>
@else

	

@endif

	      
	    	</div> <!-- /container -->
	    </div>
@endsection
	
