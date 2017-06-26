<nav class="navbar navbar-default">
<div class="container-fluid">

  <div class="navbar-header">
  <div class="brand-name"> <a class="brand" href="{{ url('/welcome') }}">What's Happening!</a> </div>
  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
  </div>
     <div class="row wrap-nav-row">
    <div class="wrap-nav navbar-collapse collapse" id="navbar">
      <ul class="nav nav-pills">
        <li role="presentation"><a href="{{ url('/welcome') }}">World</a></li>
        <li role="presentation"><a href="{{ url('/city/'.Auth::user()->getUserCity()) }}">{{  Auth::user()->getUserCity() }}</a></li>
        <li role="presentation"><a href="{{ url('nearby') }}">Nearby</a></li>
        <li role="presentation"><a href="{{ url('/tagtest')}}">Tags</a></li>
        <li><a href="/placenow/postmyphoto" class="nav-share-photo" role="button">SharePhoto</a></li>
        <li><a href="/placenow/chat" class="nav-join-chat" role="button">TalkToYourNeighbor</a></li>
        <li role="presentation"><a href="#">Search</a></li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              Me<span class="caret"></span>
          </a>

          <ul class="dropdown-menu" role="menu">
              <li><a href=""><i class="fa fa-btn fa-sign-out"></i></a></li>
              <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-sign-out"></i>Profile</a></li>
              @if(Auth::user()->email=='admin@admin.admin')
              <li><a href="{{ url('/management') }}"><i class="fa fa-btn fa-sign-out"></i>Management</a></li>
              @endif 
              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
          </ul>
      </li>
      </ul>
    </div>
    
    <div class="return_back">
    <a href="{{URL::previous()}}" > <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a>
    </div>

  </div>


</div>
</nav>