<div class="container-fluid tag-nav2-wrapper">
  <div class="wrap-nav-row-2 row">
  <div class="col-md-3 col-xs-12 navbar-left">
    <div class="tag-title col-xs-12">
      <a href="{{url('/tag/'.$select_tag['tag'])}}">#{{$select_tag['tag']}}
      @yield('tag-type')
      </a>
    </div>
  </div>
      <ul class="nav nav-pills-2 col-md-6">
        <li class="col-md-3 col-xs-3 nav-tab" role="presentation"><a class="link" href="{{url('/tag/'.$select_tag['tag'].'/top')}}">Top</a></li>
        <li class="col-md-3 col-xs-3 nav-tab" role="presentation"><a class="link" href="{{url('/tag/'.$select_tag['tag'].'/live')}}">Live </a></li>
        <li class="col-md-3 col-xs-3 nav-tab" role="presentation"><a class="link" href="{{url('/tag/'.$select_tag['tag'].'/location')}}">Locations</a></li>
        <li class="col-md-3 col-xs-3 nav-tab" role="presentation"><a class="link" href="{{url('/tag/'.$select_tag['tag'].'/more')}}"> More </a></li>
      </ul>
      <div class="col-md-3"></div>
  </div>
</div>