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


@section('content')

@section('fullscreen-content')
	<h2> LOGIN </h2>
	@include('forms.auth._login')
@endsection
