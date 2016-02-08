@extends('frontend.layouts.fullscreen')

@section('body-class')js-fullheight-body @endsection
@section('container-class')fullheight-div @endsection

@section('fullscreen-content')
	<h2> RESET PASSWORD </h2>
	@include('forms.auth._password')
@endsection

@section('after-styles-end')
	{!! HTML::style('css/fullscreen.css') !!}
@stop
