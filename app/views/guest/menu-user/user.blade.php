@if(!Auth::check())
<div class="row">
<nav id="guest-menu" class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
        	</button>
			<a class="navbar-brand" href="{{URL::route('home')}}">{{HTML::image("/images/logo/logo.svg", "DEMHUB logo", array('class' => 'img-responsive'))}}
			</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
			@if (Request::url() === URL::route('home'))
			    <li><a href="#welcome_home">Home</a></li>
			    <li><a href="#welcome_about">About</a></li>
			@else
				<li><a href="{{URL::route('home', array('#welcome_home'))}}">Home</a></li>
			    <li><a href="{{URL::route('home', array('#welcome_about'))}}">About</a></li>
			@endif
			@if (Request::url() === URL::route('sign-up'))
				<li class="active"><a href="{{URL::route('sign-up')}}">Sign Up</a></li>
			@else
				<li><a href="{{URL::route('sign-up')}}">Sign Up</a></li>
			@endif
			</ul>
			<ul class="nav navbar-nav navbar-right">
				@if (Request::url() === URL::route('login'))
					<li class="active"><a href="{{URL::route('login')}}">Log In</a></li>
				@else
					<li><a href="{{URL::route('login')}}">Log In</a></li>
				@endif
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>
</div>
@endif