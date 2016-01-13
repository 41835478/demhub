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
			<div id="welcome_home">
				<div class="card-selector col-sm-offset-1">
					<div class="col-sm-12 col-md-10 col-lg-10 col-sm-offset-1 lading-content-1">
						{!! HTML::image("/images/logo/demhub_logo-05.svg", "DEMHUB logo", array('class' => 'demhub-logo-landing', 'width' => '190')) !!}
										<a type="button" class="btn btn-style-alt btn-sm btn-style-w pull-right landing-button1" href="/auth/register">JOIN NOW</a>
					</div>
					{{-- <h5>THE DISASTER & EMERGENCY MANAGEMENT NETWORK</h5> --}}

						<div class="ajax-selector">
							<table>
								<td>
								<label for="divisions label-default" class="w-c">I am interested in: </label>
								<br>
								<div class="DrpDwn">
												<select id="DropDown_division"><option>Division</option></select>
								</div>

								</td>
										<td>
										<label for="divisions" class="w-c">My Location: </label>
										<br>
											<select class="dropdown-style">
											  <option>Random1</option>
											  <option>Science Environment</option>
											  <option>Empractitioner</option>
											  <option>Civil & Cyber Security</option>
											</select>
										</td>
				</table>

				</div>
				</div>
				<div class="card-ajax">
				<p class="w-c">	DEMHUB Newsfeeds & Professionals</p>
					<!-- the table for the jquery ajax reading !!!!! -->
					<p>
					<table class="table-details">

					</table>
					</p>

					<div class="content-landing"></div>
				</div>

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
				      <img src="/images/backgrounds/landing-hero.jpg" alt="...">
							<div class="col-sm-12 col-md-6 col-lg-6">
						</div>
				      <div class="carousel-caption col-sm-12 ">
				        <h3> THE DISASTER & EMERGENCY MANAGEMENT NETWORK</h3>
				      </div>
						</div>

				    <div class="item">
				      <img src="/images/backgrounds/welcome.jpg" alt="...">
				      <div class="carousel-caption col-sm-12 ">
				          <h3> Discover and get discovered within professional circles.</h3>
				      </div>
				    </div>
						<div class="item">
							<img src="/images/backgrounds/divisions/humanitarian.jpg" alt="...">
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
