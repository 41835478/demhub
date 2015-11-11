@extends('frontend.layouts.master')

@section('body-style')
	<style>
		body {
			padding-top: 0px !important;
		}
	</style>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div id="welcome_home" class="row js-landing-hero">

				<div class="col-md-6 col-md-offset-6 lading-content-1">
					{!! HTML::image("/images/logo/demhub_logo-05.svg", "DEMHUB logo", array('class' => 'img-responsive', 'width' => '300')) !!}
				<br></br>
				<div class="col-md-6 col-md-offset-1 text-center">
					<a type="button" class="btn btn-default btn-lg btn-style-w" href="{{url('divisions')}}">TRY THE BETA</a>
				</div>
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
					<a type="button" class="btn btn-default btn-lg btn-style-w" href="{{url('divisions')}}">SIX DIVISIONS</a>
				</div>

				<p>&nbsp;</p>
				<p>&nbsp;</p>

				<div class="row" style="margin-left: 15px; margin-right: 15px;">
					@foreach($divisions as $div)
						<a href="{{url('division', $div->slug)}}">
							<div class="division-landing-box col-md-2">
								<div id="division_{{$div->id}}">
									<div class="division-landing-icon">
										<img src ="/images/icons/division-0{{$div->id}}.svg">
									</div>
									<h3 class="division-landing-name">{{$div->name}}</h3>
								</div>
									<div class= "division-landing-color"style="background-color: #{{$div->bg_color}};"></div>
						</div>
						</a>
					@endforeach
				</div>

			</div>

			<div id="welcome_tertiary_text" class="row" >
				<div class="col-md-12 text-center">
					<h2>Help us develop the world's online DEM network.<br> Test DEMHUB’s beta and give us your feedback.</h2>
					<a type="button" class="btn btn-default btn-lg btn-style-w" href={{url('auth/register')}}>REGISTER</a>
				</div>
			</div>

			</div>
		</div>
	</div>
@stop
