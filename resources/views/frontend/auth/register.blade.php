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
	<div>
		<h2> GET THE BETA VERSION</h2>
		{{-- @include('forms.auth._register_old') --}}
		@include('forms.auth._register')
		<br>
	</div>

	<script>
		$(document).ready(function() {
		    $('#form-part-1').keydown(function(event) {
		        if (event.keyCode == 13) {
		            pageUpdate();
		         }
		    });
		});
	</script>
@endsection
