
@extends('frontend.layouts.autoload')

@section('content')
	@foreach($followEvents as $event)
		<?php dd($event); ?>
		<p>
			{{$event->follower}}
		</p>
		<p>
			{{$event->follower_type}}
		</p>
		<p>
			{{$event->followed}}
		</p>
		<p>
			{{$event->followed_type}}
		</p>
		<p>
			{{$event->updated_at}}
		</p>
	@endforeach
@endsection
