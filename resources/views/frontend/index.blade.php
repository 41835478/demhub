@extends('frontend.layouts.master')

{{-- @section('body-style')
	<style>
		body {
			padding-top: 0px !important;
		}
	</style>
@endsection --}}

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div id="welcome_home" class="row js-landing-hero">
				<div class="col-sm-6 col-sm-offset-6 lading-content-1">
					{!! HTML::image("/images/logo/demhub_logo-05.svg", "DEMHUB logo", array('class' => 'img-responsive demhub-logo-landing', 'width' => '340')) !!}

					<div class ="landing-slogan col-md-10">
						THE DISASTER & EMERGENCY MANAGEMENT NETWORK
					</div>
					<br>

					<div class="col-md-12" style="padding-left:10px">
						<a type="button" class="btn btn-default btn-lg btn-style-w" href="{{url('divisions')}}">TRY THE BETA</a>
						<a type="button" class="btn btn-default btn-lg btn-style-w" href="{{url('auth/register')}}">{{ strtoupper(trans('labels.register_button')) }}</a>
					</div>
				</div>

				<a class="col-md-offset-6 col-xs-offset-5" href="#welcome_about">
					<h3 class="glyphicon glyphicon-chevron-down" style="text-align:center;padding-top:4%"></h3>
				</a>
			</div>

			<div class="">
				<div id="welcome_about" class="row">

					<div class="col-md-12">
						<h1 style="padding-right:5px">What is DEMHUB?</h1>
						<p>DEMHUB is a networking platform built to facilitate the exchange of information, experience and resources for the Global Disaster and Emergency Management Industry.</p>
					</div>

					<div class="col-md-2 inline-about">
						<h3>News</h3>
						<i class="icon public x-lrg"></i>
						<p>Get the NEWS from reliable industry sources.</p>
					</div>

					<div class="col-md-2 inline-about">
						<h3>Discuss</h3>
						<i class="icon message x-lrg"></i>
						<p>Exchange your thoughts with millions of industry professionals.</p>
					</div>

					<div class="col-md-2 inline-about">
						<h3>Connect</h3>
						<i class="icon people x-lrg"></i>
						<p>Discover and get discovered within professional circles.</p>
					</div>

					<div class="col-md-2 inline-about">
						<h3>Research</h3>
						<i class="icon local_library x-lrg"></i>
						<p>Explore the academic researches about disaster management as well as publish your own.</p>
					</div>

					<div class="col-md-2 inline-about">
						<h3>Share</h3>
						<i class="icon share x-lrg"></i>
						<p>Upload documents, reports, articles, and more to share with your network.</p>
					</div>

					<div class="col-md-2 inline-about">
						<h3>Track</h3>
						<i class="icon place x-lrg"></i>
						<p>Track NEWS and discussions on issues that matter most to you.</p>
					</div>

				</div>
			</div>

			<div id="welcome_secondary_text" class="row">
				<div class="row">
					<div class="col-md-12 text-center">
						<a type="button" class="btn btn-default btn-lg btn-style-w" href="{{url('divisions')}}">SIX DIVISIONS</a>
					</div>

					<p>&nbsp;</p>
					<p>&nbsp;</p>


					<div class="splash-row">

							@foreach($divisions as $div)
								<a href="{{url('division', $div->slug)}}">
									<div class="division-landing-box col-md-2">
										<div id="division_{{$div->id}}">
											<div class="icon division-{{$div->slug}} landing-icon x-lrg"></div>
											<h3 class="division-landing-name">{{$div->name}}</h3>
										</div>
										<div class= "division-landing-color"style="background-color: #{{$div->bg_color}};"></div>
									</div>
								</a>
							@endforeach

					</div>


				<div id="welcome_tertiary_text" class="row">
					<div class="col-md-12 text-center">
						<h2 class="feedback-h2">Help us develop the world's online DEM network.<br> Test DEMHUB's beta and give us your feedback.</h2>
						<a type="button" class="btn btn-default btn-lg btn-style-w" href={{url('auth/register')}}>{{ strtoupper(trans('labels.register_button')) }}</a>
					</div>
				</div>

			</div>
		</div>
	</div>
@stop
