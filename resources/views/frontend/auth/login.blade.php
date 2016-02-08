@extends('frontend.layouts.fullscreen')

@section('body-class')js-fullheight-body @endsection
@section('container-class')fullheight-div @endsection

@section('fullscreen-content')
	<h2> LOGIN </h2>
	@include('forms.auth._login')
@endsection

@section('after-styles-end')
	{!! HTML::style('css/fullscreen.css') !!}
@stop
