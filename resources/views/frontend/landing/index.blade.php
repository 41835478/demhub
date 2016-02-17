@extends('frontend.layouts.landing')

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
		<!-- landing page nav bar, hard-coded no controllers -->
		<div id="landing-nav">
			<div class="landing-nav-logo">
				<a href="{{url('')}}" class="">{!! HTML::image("/images/logo/logo-min-white.png", "DEMHUB logo", array('class' => 'img-responsive','style' => 'max-width:150px')) !!}</a>
			</div>
			<li class=
				@if (Request::url() === url('about'))
				 "landing-about"
				@endif
			"landing-about"><a href="{{url('about')}}">{!! trans('ABOUT') !!}</a></li>

			<li class=
				@if (Request::url() === url('auth/register'))
				 "active "
				@endif
			"landing-about"><a href="{{url('auth/register')}}">{!! trans('JOIN NOW') !!}</a>
			</li>
			<li
				@if (Request::url() === url('auth/login'))
					class="active landing-about"
				@endif
				class="landing-about" style="float:right; margin-right:10vw;">{!! link_to('auth/login', trans('LOGIN')) !!}</li>
		</div>

		<!-- landing page major content -->
		<div id="welcome_home">
			<div class="card-selector col-sm-offset-1">
				<div class="col-sm-12 col-md-10 col-lg-10 col-sm-offset-1 lading-content-1">
					{!! HTML::image("/images/logo/demhub_logo-05.svg", "DEMHUB logo", array('class' => 'demhub-logo-landing')) !!}
				</div>
				{{-- <h5>THE DISASTER & EMERGENCY MANAGEMENT NETWORK</h5> --}}
				<div class="ajax-selector">
					<table>
						<td>
						<label for="divisions label-default" class="w-c">I am interested in: </label>
						<br>
						<div class="DrpDwn">
					 		<select id="DropDown_division" style="color:#bbb;"><option>Division</option></select>
						</div>
					</td>
						<td>
						 <a type="button" class="btn btn-style-alt btn-md btn-style-w pull-right landing-button1" href="/auth/register">JOIN NOW</a>
						</td>
						{{-- <td>
							<label for="divisions" class="w-c">My Location: </label>
						<br>
							<select class="dropdown-style">
							  <option>Random1</option>
							  <option>Science Environment</option>
							  <option>Empractitioner</option>
							  <option>Civil & Cyber Security</option>
							</select>
						</td> --}}
					</table>
			</div>
		</div>
		<div class="card-ajax">
			<!-- the table for the jquery ajax reading !!!!! -->
			<p>
			<table class="table-details1">
					<p class="w-c">	DEMHUB Professionals</p>
			</table>
			<table class="table-details2">
					<p class="w-c">	DEMHUB Newsfeeds</p>
			</table>
			</p>
			@include('frontend.landing._dropdown')
			<div class="content-landing"></div>
		</div>

		{{-- NOTE - The following line explains how to get the json content data --}}
		{{-- $content_json->getData()->content --}}
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img id="caroimage" src="/images/backgrounds/landing-hero.jpg" alt="...">
		      <div class="carousel-caption ">
		      	<h3> THE DISASTER & EMERGENCY MANAGEMENT NETWORK</h3>
		      </div>
				</div>

		    <div class="item">
                <img id="caroimage" src="/images/backgrounds/welcome.jpg" alt="...">
		      <div class="carousel-caption">
		          <h3> Discover and get discovered within professional circles.</h3>
		      </div>
               <div id="js-landing-carousel-2"></div>
		    </div>
				<div class="item">
					<img id="caroimage" src="/images/backgrounds/originals/humanitarian.jpg" alt="...">
					<div class="carousel-caption">
						<h3>Exchange your thoughts with millions of industry professionals.</h3>
					</div>
				</div>
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

			<a class="col-md-offset-6 col-xs-offset-5" href="#welcome_about">
				<h3 class="glyphicon glyphicon-chevron-down" style="text-align:center;padding-top:4%"></h3>
			</a>
		</div>
		<div id="welcome_svg" class="row">
		  	<h2 style="padding-right:5px">Connecting Professionals Worldwide</h2>
		<!-- svg map files goes here -->
	 @include('frontend.landing._svg')
</div>
		</div>

			<div id="welcome_about" class="row">

				<div class="col-md-12">
					<h2 style="padding-right:5px">What is DEMHUB?</h2>
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
</div>

@stop
