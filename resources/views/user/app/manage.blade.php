@extends('layouts.master')

@section('content')
<div id="user-manageapps" class="row">
	<div class="col-md-12">
		<h1>Your Apps</h1>
	</div>
	<div class="col-md-12">
		<table class="table table-hover">
			<tbody>
			@if($apps)
				@foreach($apps as $app)
					@if (!$app->app_configured)
						<tr class="danger">
					@else
						<tr class="info">
					@endif
							<td>{{$app->app_name}}</td>
							<td>
								<a href="{{url('app-settings', $app->id)}}">
									<i class="fa fa-gear"></i>
								</a>	
							</td>
							<td>
								<a href="">
									<i class="fa fa-trash"></i>
								</a>
							</td>
						</tr>
				@endforeach
			@endif
			</tbody>
		</table>

	</div>
</div>
@endsection('content')


