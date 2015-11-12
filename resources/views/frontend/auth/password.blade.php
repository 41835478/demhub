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

@section('fullscreen-content')
	<h2> RESET PASSWORD </h2>
	{!! Form::open(['to' => 'password/email', 'class' => 'form-horizontal', 'role' => 'form']) !!}

		<div class="form-group">
			{!! Form::label('email', trans('validation.attributes.email'), ['class' => 'col-md-4 control-label']) !!}
			<div class="col-md-6">
				{!! Form::input('email', 'email', old('email'), ['class' => 'form-control']) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				{!! Form::submit(trans('labels.send_password_reset_link_button'), ['class' => 'btn btn-default btn-lg btn-style']) !!}
			</div>
		</div>

	{!! Form::close() !!}
@endsection
