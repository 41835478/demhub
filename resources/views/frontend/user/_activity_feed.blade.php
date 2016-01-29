@if(isset($contents))
	@foreach($contents as $index => $item)
		@include('frontend.__content-card')
	@endforeach
@endif
