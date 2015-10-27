@extends('frontend.layouts.master')

@section('content')
<div class="row">
<div class="col-xs-12">
<div id="welcome_home" class="row" style="background: url('images/backgrounds/welcome_home.jpg') fixed center center no-repeat;
											-webkit-background-size: cover;
											-moz-background-size: cover;
											-o-background-size: cover;
											background-size: cover;
											overflow-x: hidden;">

	<div class="col-md-6 col-md-offset-6">
		{!! HTML::image("/images/logo/logo.svg", "DEMHUB logo", array('class' => 'img-responsive', 'width' => '700')) !!}
	</div>

	<div class="col-md-6 col-md-offset-6 text-center">
		<a type="button" class="btn btn-default btn-lg btn-style" href="{{url('divisions')}}">TRY THE BETA</a>
	</div>

</div>

<div class="" style='background: url("images/backgrounds/dots.png") repeat scroll 0 0 transparent;'>
	<div id="welcome_about" class="row">

		<div class="col-md-12">
			<h1>What is DEMHUB?</h1>
			<p>DEMHUB is a networking platform built to facilitate the exchange of information, experience and resources for the Global Disaster and Emergency Management Industry.</p>
		</div>

		<div class="col-md-2 col-md-offset-1">
			<h3>News Feeds</h3>
			<h2><i class="fa fa-newspaper-o"></i></h2>
			<p>Get the NEWS from reliable industry sources.</p>
		</div>

		<div class="col-md-2">
			<h3>Join Discussion</h3>
			<h2><i class="fa fa-comments"></i></h2>
			<p>Start or Join in discussions people should be talking about.</p>
		</div>

		<div class="col-md-2">
			<h3>Track Events</h3>
			<h2><i class="fa fa-map-pin"></i></h2>
			<p>Track NEWS and discussions on issues that matter most to you.</p>
		</div>

		<div class="col-md-2">
			<h3>Upload and Share</h3>
			<h2><i class="fa fa-files-o"></i></h2>
			<p>Upload documents, reports, articles, and more to share with your network.</p>
		</div>

		<div class="col-md-2">
			<h3>Your Custom Page</h3>
			<h2><i class="fa fa-pencil-square-o"></i></h2>
			<p>Customize your page with the resources and info that are specific to you.</p>
		</div>

	</div>
</div>

<div id="welcome_secondary_text" class="row" style="background: url('/images/backgrounds/bridge.jpg') no-repeat fixed;										-webkit-background-size: cover;
											-moz-background-size: cover;
											-o-background-size: cover;
											background-size: cover;
											overflow: hidden;">
	<div class="row">
	<div class="col-md-12 text-center">
		<a type="button" class="btn btn-default btn-lg btn-style" href="{{url('divisions')}}">SIX DIVISIONS</a>
	</div>
</div>
<br><br><br>
<div id="welcome-division-menu" class="row">
	<div class="col-xs-12" style="opacity: 0.75;filter: alpha(opacity=75);padding:0px;">

		@foreach($divisions as $div)
			<a href="{{url('division', $div->slug)}}" style="">
				<div id="division_{{$div->id}}" style="background-color: #{{$div->bg_color}};min-height:185px;max-height:185px;" class="col-md-2">
					<h3 style="text-align:center;padding-top:30px;text-transform:uppercase;">{{$div->name}}</h3>
				</div>
			</a>
		@endforeach

	</div>
</div>

<div id="welcome_tertiary_text" class="row" >
	<div class="col-md-12 text-center">
		<h2>Help us develop the world's DEM network</h2><h3>Test the beta and give us your feedback</h3><br>
		<a type="button" class="btn btn-default btn-lg btn-style" href={{url('auth/register')}}>REGISTER</a>
	</div>
</div>
</div>
</div>
</div>
@stop
