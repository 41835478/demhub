@extends('frontend.layouts.master')

@section('content')
	<div class="row">

		<div class="col-md-10 col-md-offset-1">

			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('labels.change_password_box_title') }}</div>

				<div class="panel-body">

					@include('forms.auth._change-password_old')
					@include('forms.auth._change-password')

				</div><!--panel body-->

			</div><!-- panel -->

		</div><!-- col-md-10 -->

	</div><!-- row -->
@endsection
