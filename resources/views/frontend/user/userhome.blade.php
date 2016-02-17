
@extends('frontend.layouts.autoload')

@section('body-class')userhome-body @endsection

@section('content')
	<div class="container-fluid row">

		<h3 class="text-center" style="color: #ccc">Latest</h3>

		{{-- NOTE - populated by jquery, takes partial render of _activity_feed view --}}
		<div id="activity-feed" class="col-xs-12 col-sm-offset-3 col-sm-6" data-page="0" data-url="{{url('get_activities')}}" style="border:none"></div>
	</div>
@endsection

@section('after-scripts-end')
    {!! HTML::script('js/frontend/userhome/feed.js') !!}
@stop
