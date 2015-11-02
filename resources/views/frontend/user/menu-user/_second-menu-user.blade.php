<div class="navbar navbar-inverse" id="secondary-menu" role="navigation" style="padding-left:18%;margin:0px;">

  <ul class="nav navbar-nav">
    @if(Request::url() === url('userhome'))
      <li class="active">
    @else
      <li>
    @endif
    <a href="{{url('home')}}" style="border-left:2px solid #fff"> NEWS FEED</a></li>

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
    <a href="{{url('publications')}}" style=""> PUBLICATIONS</a></li>

    @if(Request::url() === url('resource_filter'))
      <li class="active">
    @else
      <li>
    @endif
    <a href="{{url('resource_filter')}}"> RESOURCES</a></li>

    <li><a href="" style="">MAP - COMING SOON</a></li>

  	<li><a href="" style="border-right:2px solid #fff">EVENT TRACKING - COMING SOON</a></li>

	</ul>
</div>
