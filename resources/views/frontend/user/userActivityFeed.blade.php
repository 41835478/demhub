
@extends('frontend.layouts.autoload')

@section('content')
	@foreach($followEvents as $event)
		{{-- 'U' for user --}}
		@if($event->follower_type == 'U')
			<p>
				{{$event->follower}}
			</p>
			<p>
				{{$event->follower_type}}
			</p>
			<p>
				{{$event->followed_id}}
			</p>
			<p>
				{{$event->followed_type}}
			</p>
			<p>
				{{$event->updated_at}}
			</p>
		@endif
	@endforeach
@endsection
