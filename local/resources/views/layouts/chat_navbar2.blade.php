<div class="container chat-navbar hidden-xs">
<meta name="_token" content="{!! csrf_token() !!}" />
  <div class="chat-nav-row-2 row">
    @if($page_loc['type']=='public')  
      <div class="col-md-3 col-xs-12 navbar-left"> 
        <div class="chat-title col-xs-12">
          <a href="{{url('/chat')}}">Public</a>
        </div>
      </div>

      <ul class="nav nav-pills-2 col-md-6">
        <li class="col-md-4 col-xs-4 nav-tab" role="presentation">
          <a class="link" href="{{url('/chat/city/'.$position->city)}}">City</a>
        </li>

        <li class="col-md-4 col-xs-4 nav-tab" role="presentation">
          <a class="link" href="{{url('/chat/nearby')}}">NearBy</a>
        </li>
       
        <li class="col-md-4 col-xs-4 nav-tab" role="presentation">
          <a class="link" href="{{url('/chat/locationload')}}">Locations</a>
        </li>
      </ul>
      
      <div class="col-md-3"></div>
      
    @elseif($page_loc["type"]=='city')
      <div class="col-md-3 col-xs-12 navbar-left"> 
        <div class="chat-title col-xs-12">
          <a href="{{url('/chat/city/').'/'.$position->city}}">{{$position->city}}</a>
        </div>
      </div>

      <ul class="nav nav-pills-2 col-md-6">
        <li class="col-md-4 col-xs-4 nav-tab" role="presentation">
          <a class="link" href="{{url('/chat')}}">Public </a>
        </li>

        <li class="col-md-4 col-xs-4 nav-tab" role="presentation">
          <a class="link" href="{{url('/chat/nearby')}}">NearBy</a>
        </li>
       
        <li class="col-md-4 col-xs-4 nav-tab" role="presentation">
          <a class="link" href="{{url('/chat/locationload')}}">Locations</a>
        </li>
      </ul>

    @elseif($page_loc["type"]=="nearby")
      <div class="col-md-3 col-xs-12 navbar-left"> 
        <div class="chat-title col-xs-12">
          <a href="{{url('/chat/nearby')}}">NearBy</a>
        </div>
      </div>

      <ul class="nav nav-pills-2 col-md-6">
        <li class="col-md-4 col-xs-4 nav-tab" role="presentation">
          <a class="link" href="{{url('/chat')}}">Public </a>
        </li>

        <li class="col-md-4 col-xs-4 nav-tab" role="presentation">
          <a class="link" href="{{url('/chat/city/'.$position->city)}}">City</a>
        </li>
       
        <li class="col-md-4 col-xs-4 nav-tab" role="presentation">
          <a class="link" href="{{url('/chat/locationload')}}">Locations</a>
        </li>
      </ul>

      @elseif($page_loc["type"]=="location-loading")
      <div class="col-md-3 col-xs-12 navbar-left"> 
        <div class="chat-title col-xs-12">
          <a href="{{url('/chat/locationload')}}">Location Loading</a>
        </div>
      </div>

      <ul class="nav nav-pills-2 col-md-6">
        <li class="col-md-4 col-xs-4 nav-tab" role="presentation">
          <a class="link" href="{{url('/chat')}}">Public </a>
        </li>

        <li class="col-md-4 col-xs-4 nav-tab" role="presentation">
          <a class="link" href="{{url('/chat/nearby')}}">NearBy</a>
        </li>

        <li class="col-md-4 col-xs-4 nav-tab" role="presentation">
          <a class="link" href="{{url('/chat/city/'.$position->city)}}">City</a>
        </li>

       @elseif($page_loc["type"]=='location')
       <div class="col-md-3 col-xs-12 navbar-left"> 
        <div class="chat-title col-xs-12">
          <a href="{{url('/chat/location/'.$place_selected->related_id)}}">{{$place_selected->name}}</a>
        </div>
      </div>

      <ul class="nav nav-pills-2 col-md-6">
        <li class="col-md-4 col-xs-4 nav-tab" role="presentation">
          <a class="link" href="{{url('/chat')}}">Public </a>
        </li>

        <li class="col-md-4 col-xs-4 nav-tab" role="presentation">
          <a class="link" href="{{url('/chat/nearby')}}">NearBy</a>
        </li>

        <li class="col-md-4 col-xs-4 nav-tab" role="presentation">
          <a class="link" href="{{url('/chat/city/'.$position->city)}}">City</a>
        </li>
        @endif
      </ul>

      <div class="col-md-3"></div>    
  </div>
</div>


<div class="contain-fluid chat-mobile-navbar-wrapper visible-xs-block">
  
  <div class="chat-mobile-nav row">

  <ul class="nav nav-pills-mobile col-xs-12">

    <li class="col-xs-3 nav-tab" role="presentation">
      <a class="link" href="{{url('/chat')}}">Public</a>
    </li>
    <li class="col-xs-3 nav-tab" role="presentation">
      <a class="link" href="{{url('/chat/city/'.$position->city)}}">City </a>
    </li>

    <li class="col-xs-3 nav-tab" role="presentation">
      <a class="link" href="{{url('/chat/nearby')}}">NearBy</a>
    </li>

    <li class="col-xs-3 nav-tab" role="presentation">
      <a class="link" href="{{url('/chat/locationload')}}">Locations</a>
    </li>

  </ul>
  <div class="mobile-pulldown col-xs-12"><span class="glyphicon glyphicon-menu-hamburger" ></span></div>
  </div>
</div>