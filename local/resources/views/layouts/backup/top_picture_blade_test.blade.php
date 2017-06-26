
<nav class="navbar navbar-default">
  <div class="container-fluid whole-navbar">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/welcome') }}">What's Happening!</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse center_navbar" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a id="link" href="{{ url('/welcome') }}">World <span class="sr-only">(current)</span></a></li>
        <li><a id="link" href="{{ url('/city/'.Auth::user()->getUserCity()) }}">{{  Auth::user()->getUserCity() }}</a></li>
        <li><a id="link" href="{{ url('nearby') }}">Nearby</a></li>
        <li><a id="link" href="{{ url('/tagtest')}}">Tags</a></li>

        <li><a id="link" href="/placenow/postmyphoto" class="nav-share-photo" role="button">SharePhoto</a></li>
        <li><a id="link" href="/placenow/chat" class="nav-join-chat" role="button">TalkToYourNeighbor</a></li>
        <li role="presentation"><a id="link" href="#">Search</a></li>

        <li class="dropdown">
          <a id="link" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              Me<span class="caret"></span>
          </a>

          <ul class="dropdown-menu" role="menu">
              
              <li><a id="link" href="{{ url('/profile') }}"><i class="fa fa-btn fa-sign-out"></i>Profile</a></li>
              @if(Auth::user()->email=='admin@admin.admin')
              <li><a id="link"  href="{{ url('/management') }}"><i class="fa fa-btn fa-sign-out"></i>Management</a></li>
              @endif 
              <li><a id="link"  href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
          </ul>
      </li>

      </ul>
  
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{URL::previous()}}" > <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
