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
		<h2>{{ strtoupper(trans('forms.register_title')) }}</h2>
			@include('forms.auth._register')
		<br>
	</div>

	@if(Request::url() == url('auth/register'))
		<script>
			$("input#password").focus(function(){
				setTimeout(function(){updateForm()},600);
			});
		</script>
	@elseif(Request::url() == url('auth/autoregister'))
		<script charset="utf-8">
			document.getElementById("password").focus();
		</script>
  @endif

@endsection
