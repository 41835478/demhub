@extends('frontend.layouts.master')

@section('body-class')  @endsection

@section('content')
	<div class="container-fluid row">
		<div style="padding: 50px 0;margin: 50px 0;background: rgba(0,0,0,0.05);">
			<h2 class="text-center" style="">
				Successfully unsubscribed <br> <span class="text-bold">"{{$email}}"</span>
			</h2>
		</div>
	</div>
@endsection

@section('after-scripts-end')

@stop
