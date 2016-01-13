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

	</div>
@stop
