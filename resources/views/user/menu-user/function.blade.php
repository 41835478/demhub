@if(Auth::check())

<nav id="user-function" class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	        <span class="sr-only">Toggle navigation</span>

	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
    	</button>
		<a href="{{url('home')}}">{!! HTML::image("/images/logo/logo-min-white.png", "DEMHUB logo", array('class' => 'img-responsive','style' => 'width:175px;padding-left:30px;padding-top:10px')) !!}
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
                <!-- @if(Request::url() === url('main-home'))
                    <li class="active">
                        <a href="{{url('main-home')}}">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{url('main-home')}}">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                @endif -->
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


                @endif


            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li style="padding:0;">
                    <a style="padding:5% 0 0 0;">
                        @include('forms.search')
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{Auth::user()->user_name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
		                @if(Request::url() === url('profile'))
		                    <li>
		                        <a href="{{url('profile')}}">
		                            <i class="fa fa-user"> PROFILE</i>
		                        </a>
		                    </li>
		                @else
		                    <li>
		                        <a href="{{url('profile')}}">
		                            <i class="fa fa-user"></i> PROFILE</a>
		                    </li>
		                @endif
                        <li>
                            <a href="{{url('user-settings')}}">Settings
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ Auth::logout() }}">Log-Out
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!--/.nav-collapse -->
    </div>
</nav>

<div class="row" style="padding-top:52px;">
	<div id="welcome-division-menu" class="col-xs-12" style="opacity: 0.75;filter: alpha(opacity=75);padding:0px;">
		@foreach($xmlcategories as $category)

			<a href="{{url('division', array('id' => $category->id))}}">
				<div id="division_{{$category->id}}" style="opacity: 0.75;filter: alpha(opacity=75);background-color: #{{$category->bg_color}};min-height:67px;max-height:67px" class="col-md-2">
					<p style="text-align:center;padding-top:11px">{{$category->category_name}}</p>
				</div>
			</a>

		@endforeach

</div>
</div>

<div class="row" style="">
	<div class="col-md-8" style="max-height:350px;overflow-y:hidden;padding:0px">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="max-height:350px">
  <!-- Indicators -->
  <ol class="carousel-indicators">
	<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	@foreach($xmlcategories as $category)
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
		@foreach($xmlcategories as $category)
    <div class="item">
      <img src="./images/backgrounds/{{$category->bg_image}}" class="img-responsive" alt="{{$category->id}} Image" style="">
      <div class="carousel-control" style="opacity: 1;filter: alpha(opacity=100);padding-left:150px;padding-top:20px">
        {{$category->category_name}}
      </div>
    </div>
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
		<h3>LATEST NEWS</h3>
		<div class="col-md-9 col-md-offset-1" style="overflow-x:hidden">

			<div id="ph-text" class="text-left">

					<div class="col-md-12">
						<h3><a href="" style="color:#000">Article Title</a></h3>


						<span class="label label-default" >publication Date</span>
						<p>Description, Description, Description, Description.</p>

						<hr>

					</div>

			</div>
		</div>
	</div>
	<a id="adjustPage" href="#adjustPage" style="visibility:hidden">_</a>
</div>

<div class="row">
	<div class="navbar navbar-inverse" role="navigation" style="padding-left:30%;">

  	          <ul class="nav navbar-nav">
				<li><a href="{{url('logout')}}" style="color:#666666;border-left:2px solid #fff;border-right:1px solid #fff"><!-- <img src="css/hot-potato-black-text-with-logo.png" class="blackImage" alt="Hot Potato" width="101.48" height="22" style="padding-bottom:0px;"><img src="css/hot-potato-white-text-with-logo.png" class="whiteImage" alt="Hot Potato" width="101.48" height="22" style="padding-bottom:0px;"> --> NEWS FEED</a></li>

				<li><a href="{{url('resource-filter')}}" style="color:#666666;border-left:1px solid #fff;border-right:1px solid #fff"> RESOURCES</a></li>



  	            <li><a href="{{url('events')}}" style="color:#666666;border-left:1px solid #fff;border-right:1px solid #fff"><!-- <img src="css/cut-video-image-black.png" class="blackImage" alt="Hot Potato" width="35.24" height="23.5" style="padding-top:2px"><img src="css/cut-video-image-white.png" class="whiteImage" alt="Hot Potato" width="35.24" height="23.5" style="padding-top:2px"> --> EVENTS</a></li>

  				<!-- <li><a href="{url('logout')}}"><img src="css/share-image-black.png" class="blackImage" alt="Hot Potato" width="55" height="21" style=""><img src="css/share-image-white.png" class="whiteImage" alt="Hot Potato" width="55" height="21" style=""> Feed</a></li> -->
  				<li><a href="{{url('media')}}" style="color:#666666;border-left:1px solid #fff;border-right:2px solid #fff">MEDIA</a></li>

  	            <!-- <li role="presentation"><a href="{url('logout')}}">About &amp; Contact</a></li> -->


  	      </div>

	</div>

	</div>

	<script>
	window.onload = function() {
		setTimeout(function(){document.getElementById("adjustPage").click();},115);
	}
	</script>
@endif
