<div class="row" >
  <div class="navbar navbar-inverse" id="secondary-menu" role="navigation" style="margin-bottom:0px">
    <div class="col-lg-10 col-lg-offset-2 col-md-11 col-md-offset-1">


      <ul class="nav navbar-nav">
        @if( strpos(Request::url(), 'division') ==true || Request::url() == url('divisions') )
          <li class="active">
        @else
          <li>
        @endif

        <a href="" data-toggle="modal" data-target="#DEMHUBModal" style="border-left:2px solid #fff"> NEWS FEED</a></li>

        @if(Request::url() == url('forum/all_threads'))
          <li class="active">
        @else
          <li>
        @endif
        <a href="" data-toggle="modal" data-target="#DEMHUBModal"> DISCUSSION</a></li>

        @if(Request::url() == url('publications'))
          <li class="active">
        @else
          <li>
        @endif
        <a href="" data-toggle="modal" data-target="#DEMHUBModal" style="padding-left:15px;padding-right:15px;"> PUBLICATIONS</a></li>

        @if(Request::url() == url('publications'))
          <li class="active">
        @else
          <li>
        @endif
        <a href="" data-toggle="modal" data-target="#DEMHUBModal" style="padding-left:15px;padding-right:15px;"> NETWORK</a></li>

        @if(Request::url() === url('resource_filter'))
          <li class="active">
        @else
          <li>
        @endif
        <a href="" data-toggle="modal" data-target="#DEMHUBModal"> RESOURCES</a></li>

        {{-- <li><a href="javascript:comingSoon('map_title')" id="map_title" style="padding-left:15px;padding-right:15px;"> MAP</a></li> --}}

      	<li><a href="" data-toggle="modal" data-target="#DEMHUBModal" style="padding-left:15px;padding-right:15px;border-right:2px solid #fff"> TRACK EVENTS</a></li>

        @if(Request::url() === url('search'))
          <li class="active">
        @else
          <li>
        @endif
        <a href="" data-toggle="modal" data-target="#DEMHUBModal"> SEARCH ALL</a></li>

    	</ul>
    </div>
  </div>
</div>
