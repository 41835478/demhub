@extends('frontend.layouts.master')

@section('body-class')userhome-body @endsection

@section('content')
	<div class="container-fluid row">
		<h1>Activity feed</h1>

		{{-- NOTE - populated by jquery, takes partial render of _activity_feed view --}}
		<div id="activity-feed" class="col-xs-12 col-sm-offset-2 col-sm-8" data-page="0" data-url="{{url('get_activities')}}" style="border:none"></div>
	</div>
@endsection

@section('after-scripts-end')
    {!! HTML::script('js/frontend/userhome/feed.js') !!}
@stop
