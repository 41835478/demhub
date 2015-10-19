@extends('frontend.layouts.master')

@section('content')

	@include('division._welcome_division')

	@include('division._restricted_access')

	@include('division._search')

	<div class="col-md-9 col-md-offset-1" style="overflow-x:hidden">

		@foreach ($queryResults as $item)
			{{ $item }}
		@endforeach

	</div>

@stop
