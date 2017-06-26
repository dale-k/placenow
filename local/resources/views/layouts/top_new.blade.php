<div class="container-fluid nav-fluid navbar-fixed-top padding-remove">
<div class="container padding-remove">
  <div class="row top">
    <div class="col-md-12">
      <a class="brand" href="{{ url('/welcome') }}">PlaceNow</a>
    </div>
  </div>
  <div class="row wrap-nav-row">
    <a class="small-brand" href="{{ url('/welcome') }}">PlaceNow</a>
    <div class="wrap-nav" id="navbar">
      <ul class="nav nav-pills hidden-xs">
        <li role="presentation"><a href="{{ url('/welcome') }}">World</a></li>
        <li role="presentation">
          @if ( Auth::guest() )
            <a href="" id="guest-city" onclick="guestCity();">yourCity</a>
          @else
            <a href="{{  url('/city/'.Auth::user()->getUserCity()) }}">{{  Auth::user()->getUserCity() }}</a>
          @endif
        </li>
        <li role="presentation"><a href="{{ url('nearby') }}">Nearby</a></li>
        <li role="presentation"><a href="{{url('/tag')}}">Tags</a></li>
        <li>
          <a href="/placenow/postmyphoto" class="nav-share-photo" role="button">
            <!--<span class="glyphicon glyphicon-camera" aria-hidden="true"></span>-->
            SharePhoto
          </a>
        </li>
        <li>
          <a href="#" class="nav-join-chat" role="button" onclick="recordChatClick();">
            {{-- <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> --}}
            TalkToYourNeighbor
          </a>
        </li>
        <li role="presentation"><a href="#" data-toggle="modal" data-target="#searchModal">Search</a></li>
        <li>
          <a href="#collapseAsk" class="nav-ask-collapse" data-toggle="modal" data-target="#askModal">
            Ask
          </a>
        </li>
        @if ( !Auth::guest() )
        <li class="dropdown">
          <a href="#" id="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
          {{Auth::user()->user}}<span class="caret"></span>
          </a>

          <ul class="dropdown-menu profile-dropdown" role="menu">
            <li><a href="{{ url('/me/mypage') }}"><i class="fa fa-btn fa-sign-out"></i>MyPage</a></li>
            <li><a href="{{ url('/me/myaccount') }}"><i class="fa fa-btn fa-sign-out"></i>MyAccount</a></li>
            @if(Auth::user()->email=='admin@admin.admin')
            <li><a href="{{ url('/management') }}"><i class="fa fa-btn fa-sign-out"></i>Management</a></li>
            @endif 
            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
          </ul>
        </li>
        @else
        <li role="presentation"><a id ="login" href="{{ url('login') }}">Login</a></li>
        <li role="presentation"><a id="register" href="{{ url('register') }}">Register</a></li>
        @endif
      </ul>
      <!-- mobile menu -->
      <ul class="nav nav-pills hidden-md hidden-lg" role="">
        <li class="">
          <a class="" id="dk-mobile-menu-opener">
            <span class="glyphicon glyphicon-th" aria-hidden="true"></span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>

  <div class="row dk-mobile-menu-list hidden-md hidden-lg padding-remove" id="dk-mobile-menu-list">
    <a href="{{ url('/welcome') }}" class="col-xs-12 dk-menu-list">
      World
    </a>
    @if ( Auth::guest() )
      <a id="guest-city" onclick="guestCity();" class="col-xs-12 dk-menu-list">City</a>
    @else
      <a href="{{  url('/city/'.Auth::user()->getUserCity()) }}" class="col-xs-12 dk-menu-list">{{  Auth::user()->getUserCity() }}</a>
    @endif
    <a href="{{ url('nearby') }}" class="col-xs-12 dk-menu-list">
      NearBy
    </a>
    <a href="{{url('/tag')}}" class="col-xs-12 dk-menu-list">
      Tags
    </a>
    <a href="/placenow/postmyphoto" class="col-xs-12 dk-menu-list">
      Post
    </a>
    <a class="col-xs-12 dk-menu-list" onclick="recordChatClick();return window.location.href='{{url('/chat')}}';">
      Chat
    </a>
    <a class="col-xs-12 dk-menu-list" data-toggle="modal" data-target="#searchModal">
      search
    </a>
    @if ( !Auth::guest() )
    <a href="#collapseAsk" class="col-xs-12 dk-menu-list" data-toggle="modal" data-target="#askModal">
      Ask
    </a>
    <a href="{{ url('/me/mypage') }}" class="col-xs-12 dk-menu-list">
      Mypage
    </a>
    <a href="{{ url('/me/myaccount') }}" class="col-xs-12 dk-menu-list">
      MyAccount
    </a>
    <a href="{{ url('/logout') }}" class="col-xs-12 dk-menu-list">
      Logout
    </a>
    @else
    <a id ="login" class="col-xs-12 dk-menu-list" href="{{ url('login') }}">Login</a>
    <a id="register" class="col-xs-12 dk-menu-list" href="{{ url('register') }}">Register</a>
    @endif
  </div>

</div>

<!-- Ask Modal -->
<div class="modal fade" id="askModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <form form="askForm" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Ask Question</h4>
        </div>
        <div class="modal-body">
          
            <div class="form-group">
              <label for="">Which City?</label>
              <input type="text" id="ask-city" class="form-control ask-question" name="city" placeholder="City">
            </div>
            <div class="form-group">
              <label for="">Place? (not necessary)</label>
              <input type="text" id="ask-place" class="form-control ask-city" name="place" placeholder="Place">
            </div>
            <div class="form-group">
              <label for="">Ask Question</label>
              <input type="text" id="ask-question" class="form-control ask-place" name="question" placeholder="Place">
            </div>

            <form id="askForm" method="POST" action="{{ url('/ask/sendQuestion') }}">
            </form>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="submitAskForm();">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <form form="askForm" role="form" method="POST" action="{{ url('/search') }}">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="text" class="form-control ask-question" name="ask" placeholder="Ask">
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>