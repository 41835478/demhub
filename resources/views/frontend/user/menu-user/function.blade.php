@if(Auth::check() && ! empty($allDivisions))

<nav id="user-function" class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	    <span class="sr-only">Toggle navigation</span>

	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
    </button>
		<a href="{{url('userhome')}}">{!! HTML::image("/images/logo/logo-min-white.png", "DEMHUB logo", array('class' => 'img-responsive','style' => 'width:175px;padding-left:30px;padding-top:10px')) !!}
		</a>
	</div>

	<div class="container">
	<div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a>
                        <kbd>BETA</kbd>
                    </a>
                </li>
                <!-- @if(Request::url() === url('home'))
                    <li class="active">
                        <a href="{{url('userhome')}}">
                            <i class="fa fa-user"> PROFILE</i>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{url('home')}}">
                            <i class="fa fa-user"></i> PROFILE</a>
                    </li>
                @endif
                @if(Request::url() === url('discover'))
                <li class="active">
                	<a href="{{url('discover')}}"><i class="fa fa-globe"></i> DISCOVER</a>
                </li>
                @else
                <li>
                    <a href="{{url('discover')}}"><i class="fa fa-globe"></i> DISCOVER</a>
                </li>
                @endif
                @if(Request::url() === url('discussion'))
                <li class="active">
                    <a href="{{url('discussion')}}"><i class="fa fa-comments"></i> DISCUSSION</a>
                </li>
                @else
                <li>
                    <a href="{{url('discussion')}}"><i class="fa fa-comments"></i> DISCUSSION</a>
                </li>


                @endif -->


            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li style="padding:0;">
                    <a style="padding:5% 0 0 0;">
                        <!-- @include('forms.search') -->
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{Auth::user()->user_name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{url('self_profile')}}">USER DASHBOARD
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            {!! link_to('auth/logout', trans('LOGOUT')) !!}
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!--/.nav-collapse -->
    </div>
</nav>
@if (!isset($userMenu))
<div class="row" style="padding-top:52px;">
	<div id="welcome-division-menu" class="col-xs-12" style="opacity: 0.75;filter: alpha(opacity=75);padding:0px;">
		@foreach($allDivisions as $category)
			<a href="{{url('division', array('slug' => $category->slug))}}">
				<div id="division_{{$category->id}}" style="opacity: 0.75;filter: alpha(opacity=75);background-color: #{{$category->bg_color}};min-height:67px;max-height:67px" class="col-md-2">
					<p style="text-align:center;padding-top:11px;text-transform:uppercase;">{{$category->name}}</p>
				</div>
			</a>
		@endforeach

</div>
</div>

<div class="row" style="">
	<div class="col-md-8" style="max-height:500px;overflow-y:hidden;padding:0px">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="max-height:500px">
  <!-- Indicators -->
  <ol class="carousel-indicators">
	<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	@foreach($allDivisions as $category)
    <li data-target="#carousel-example-generic" data-slide-to="{{$category->id}}"></li>
	@endforeach
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="./images/backgrounds/bridge.jpg" class="img-responsive" alt="" style="">
      <div class="carousel-control" style="opacity: 1;filter: alpha(opacity=100);padding-left:200px;padding-top:20px">
      	<p>WELCOME<font style="visibility:hidden">*</font>TO<font style="visibility:hidden">*</font>DEMHUB!</p>
      </div>
    </div>
		@foreach($allDivisions as $category)
    <div class="item">
	<a href="{{url('division', array('slug' => $category->slug))}}">
      <img src="./images/backgrounds/divisions/{{$category->slug}}.jpg" class="img-responsive" alt="{{$category->slug}} Image" style="">
      <div class="carousel-control" style="opacity: 1;filter: alpha(opacity=100);padding-left:150px;padding-top:20px">
        {!! $category->welcome_message !!}
      </div>
    </div>
	</a>
	@endforeach

  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
	<div class="col-md-4">
		<h3>COMING SOON</h3>
		<div class="col-md-9 col-md-offset-1" style="overflow-x:hidden">

			<div id="ph-text" class="text-left">

					<div class="col-md-12">
						<h4>DISCUSSION</h4>
						<!-- <span class="label label-default" >publication Date</span>
						<p>Description, Description, Description, Description.</p> -->
						<hr>
						<h4>SEARCH</h4>
						<hr>
						<h4>GROUPS</h4>
						<hr>
						<h4>TRENDING NEWS</h4>
						<hr>
						<h4>EVENT TRACKING</h4>
						<hr>
						<h4>INTERACTIVE MAP</h4>
						<hr>
					</div>

			</div>

		</div>
<a id="adjustPage" href="#adjustPage" style="visibility:hidden">_</a>
	</div>
</div>

<div class="row">
	<div class="navbar navbar-inverse" role="navigation" style="padding-left:20%;">

  	          <ul class="nav navbar-nav">
 				 @if(Request::url() === url('userhome'))
 				 <li class="active">
 				 @else
 				 <li>
 				 @endif
				<a href="{{url('userhome')}}" style="color:#666666;border-left:2px solid #fff;border-right:1px solid #fff"><!-- <img src="css/hot-potato-black-text-with-logo.png" class="blackImage" alt="Hot Potato" width="101.48" height="22" style="padding-bottom:0px;"><img src="css/hot-potato-white-text-with-logo.png" class="whiteImage" alt="Hot Potato" width="101.48" height="22" style="padding-bottom:0px;"> --> NEWS FEED</a></li>
				 @if(Request::url() === url('discussion'))
				 <li class="active">
				 @else
				 <li>
				 @endif
				<a href="{{url('userhome')}}" style="color:#666666;border-left:1px solid #fff;border-right:1px solid #fff"> DISCUSSION - COMING SOON</a></li>
				 @if(Request::url() === url('resource_filter'))
				 <li class="active">
				 @else
				 <li>
				 @endif
				<a href="{{url('resource_filter')}}" style="color:#666666;border-left:1px solid #fff;border-right:1px solid #fff"> RESOURCES</a></li>

  	            <li><a href="{{url('userhome')}}" style="color:#666666;border-left:1px solid #fff;border-right:1px solid #fff">EVENTS - COMING SOON</a></li>

  				<!-- <li><a href="{url('logout')}}"><img src="css/share-image-black.png" class="blackImage" alt="Hot Potato" width="55" height="21" style=""><img src="css/share-image-white.png" class="whiteImage" alt="Hot Potato" width="55" height="21" style=""> Feed</a></li> -->
  				<li><a href="{{url('userhome')}}" style="color:#666666;border-left:1px solid #fff;border-right:2px solid #fff">MEDIA - COMING SOON</a></li>

  	            <!-- <li role="presentation"><a href="{url('logout')}}">About &amp; Contact</a></li> -->
  	      </div>
	</div>

	</div>
	<script>
	window.onload = function() {
		setTimeout(function(){document.getElementById("adjustPage").click();},115);
	}
	</script>
	<br>
@endif
@endif
