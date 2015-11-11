<div class="row" >
  <div class="navbar navbar-inverse" id="secondary-menu" role="navigation" style="margin-bottom:0px">
    <div class="col-md-10 col-md-offset-3">


      <ul class="nav navbar-nav">
        @if(Request::url() === url('userhome'))
          <li class="active">
        @else
          <li>
        @endif
        <a href="{{url('userhome')}}" style="border-left:2px solid #fff"> NEWS FEED</a></li>

        @if(Request::url() == url('forum/all_threads'))
          <li class="active">
        @else
          <li>
        @endif
        <a href="{{url('forum/all_threads')}}" style=""> DISCUSSION</a></li>

        @if(Request::url() == url('publications'))
          <li class="active">
        @else
          <li>
        @endif
        <a href="javascript:comingSoon('publications_title')" id="publications_title" style="padding-left:45px;padding-right:45px;"> PUBLICATIONS</a></li>

        @if(Request::url() === url('resource_filter'))
          <li class="active">
        @else
          <li>
        @endif
        <a href="{{url('resource_filter')}}"> RESOURCES</a></li>

        {{-- <li><a href="javascript:comingSoon('map_title')" id="map_title" style="padding-left:45px;padding-right:45px;"> MAP</a></li> --}}

      	<li><a href="javascript:comingSoon('event_tracking_title')" id="event_tracking_title" style="padding-left:45px;padding-right:45px;border-right:2px solid #fff"> TRACK EVENTS</a></li>

    	</ul>
    </div>
  </div>
</div>
