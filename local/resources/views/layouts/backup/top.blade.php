<div class="navbar-wrapper container-fluid">
    <div class="container">

      <nav class="navbar navbar-inverse navbar-static-top header-wrap">
        <div class="container">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{ url('/') }}">What's Hapning!</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-right">
              <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li>
                          <a href="/placenow/postmyphoto" class="nav-share-photo" role="button">
                            <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
                          </a>
                        </li>
                        <li>
                          <a href="/placenow/chat" class="nav-join-chat" role="button">
                            <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                          </a>
                        </li>
                        <li>
                          <a href="#collapseAsk" class="nav-ask-collapse" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseAsk">
                            <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                          </a>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->user }} <span class="caret"></span>
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
                    @endif

            </ul>

            <form class="navbar-form navbar-right" role="search">
              <div class="form-group">
                <input type="text" class="form-control" id="search_input" autocomplete="off" placeholder="Search" data-container="body" data-toggle="popover" data-placement="bottom" data-content="">
              </div>
              <button type="submit" class="btn btn-default">Go</button>
            </form>
            
          </div>
          
        </div>
      </nav>

    </div>
</div>
<div class="collapse" id="collapseAsk">
  <div class="well">
    <form form="askForm" role="form" method="POST" action="{{ url('/ask') }}">
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="text" class="form-control ask-question" name="ask" placeholder="Ask">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="text" class="form-control ask-city" name="city" placeholder="City">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="text" class="form-control ask-place" name="place" placeholder="Place">
      </div>

      <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

      <button type="submit" class="btn btn-default">Submit</button>
    </form>
  </div>
</div>


