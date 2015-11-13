@extends('frontend.layouts.fullscreen')

@section('body-class')js-fullheight-body @endsection
@section('container-class')fullheight-div @endsection

@section('body-style')
	<style>
		body {
			padding-top: 0px !important;
		}
	</style>
@endsection

@section('fullscreen-content')
	<h2> RESET PASSWORD </h2>
	@include('forms.auth._password_old')
	@include('forms.auth._password')
@endsection
