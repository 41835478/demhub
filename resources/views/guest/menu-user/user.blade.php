@if(!Auth::check())
<div class="row" >
<nav id="guest-menu" class="navbar navbar-default navbar-fixed-top">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		        <span class="sr-only">Toggle navigation</span>

		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
        	</button>
			<a href="{{url('')}}">{!! HTML::image("/images/logo/logo-min-white.png", "DEMHUB logo", array('class' => 'img-responsive','style' => 'width:175px;padding-left:30px;padding-top:10px')) !!}
			</a>
		</div>

		<div class="container">
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
			@if (Request::url() === url('home'))
			    <li><a href="about-us">About</a></li>
			@else
			    <li><a href="{{url('about-us')}}">About</a></li>
			@endif
			@if (Request::url() === url('sign-up'))
				<li class="active"><a href="{{url('sign-up')}}">Sign Up</a></li>
			@else
				<li><a href="{{url('sign-up')}}">Sign Up</a></li>
			@endif
			</ul>
			<ul class="nav navbar-nav navbar-right" style="">
				@if (Request::url() === url('login'))
					<li class="active"><a href="{{url('login')}}">Log In</a></li>
				@else
					<li><a href="{{url('login')}}">Log In</a></li>
				@endif
			</ul>
		</div><!--/.nav-collapse -->
	</div>

</nav>
</div>
@endif
