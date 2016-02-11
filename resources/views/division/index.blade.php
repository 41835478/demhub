@extends('frontend.layouts.autoload')

{{-- @section('body-class')userhome-body @endsection --}}

@section('content')
	@include('division._welcome_division')
	@if (!url('userhome'))
	    <div class="row">
	        <div class="col-md-10 col-md-offset-2" style="overflow-x:hidden">
	            <h2><span class="label label-info" style="background-color:rgba(0, 0, 0, 0.7);">NEWS FEED</span><h2>
	        </div>
	    </div>
	@else
	    <div style="padding-bottom:20px"></div>
	@endif

	<div class="container-fluid row">
		{{-- NOTE - populated by jquery, takes partial render of _activity_feed view --}}
		<div id="activity-feed" class="col-xs-12 col-sm-offset-3 col-sm-6" data-page="0" data-url="{{url('get_articles/'.$scope)}}" style="border:none"></div>
	</div>
@endsection

@section('modal')
	@include('modals._restricted_access')
@endsection

@section('after-scripts-end')
    {!! HTML::script('js/frontend/userhome/feed.js') !!}
@stop
