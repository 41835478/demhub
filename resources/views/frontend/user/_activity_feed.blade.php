@if(isset($contents))
	@foreach($contents as $index => $item)
		@include('frontend.card._card')
	@endforeach
@endif
