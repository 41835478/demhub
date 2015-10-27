
<div class="row" @if (Request::url() !== url('userhome')) style="padding-top:52px;" @endif>
	<div class="navbar navbar-inverse" id="secondary-menu" role="navigation" style="padding-left:18%;">

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
				 @if(Request::url() === url('resource_filter'))
				 <li class="active">
				 @else
				 <li>
				 @endif
				<a href="{{url('resource_filter')}}"> RESOURCES</a></li>

  	            <li><a href="" style="">MAP - COMING SOON</a></li>

  				<!-- <li><a href="{url('logout')}}"><img src="css/share-image-black.png" class="blackImage" alt="Hot Potato" width="55" height="21" style=""><img src="css/share-image-white.png" class="whiteImage" alt="Hot Potato" width="55" height="21" style=""> Feed</a></li> -->
  				<li><a href="">CONNECTIONS - COMING SOON</a></li>
					<li><a href="" style="border-right:2px solid #fff">EVENT TRACKING - COMING SOON</a></li>
  	            <!-- <li role="presentation"><a href="{url('logout')}}">About &amp; Contact</a></li> -->
  	      </div>
	</div>
