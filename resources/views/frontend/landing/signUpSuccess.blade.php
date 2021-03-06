@extends('frontend.layouts.fullscreen')

@section('body-class')js-thankyou-page @endsection
@section('container-class')fullheight-div @endsection

@section('fullscreen-content')
	<div class="col-md-6 col-md-offset-3" style="color:#fff">
		<h3>THANK YOU FOR REGISTERING!</h3>
		<br>
		<h4>We've sent you a confirmation email. Your account will be active once it has been verified by a DEMHUB staff member; this will be done within 24 hours.</h4>
		<br>
		<h4>If you have questions, issues, or an inquiry contact us at <a href="mailto:demhubcontact@gmail.com?Subject=DEMHUB%20Inquiry" target="_top" style="color:#9babcc">demhubcontact@gmail.com</a> </h4>
	</div>
@endsection('content')

@section('after-styles-end')
	{!! HTML::style('css/fullscreen.css') !!}
@stop
