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

@section('modal')
	@include('modals._register_prompt')
@endsection

@section('fullscreen-content')
	<div class="col-xs-12 col-sm-6 col-sm-offset-3">
		<h2>REGISTER NOW, IT'S FREE!</h2>
			@include('forms.auth._register_auto')
		<br>
	</div>

	<script charset="utf-8">
		document.getElementById("password").focus();
	</script>
@endsection
