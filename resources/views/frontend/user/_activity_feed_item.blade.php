<div class = "col-xs-12" style="background: white;box-shadow:0px 3px 5px rgba(0,0,0,0.3); margin: 15px 0;">

	@if(isset($item))
		@if ($item->subclass == "publication")
		  <p style="">{{ $item->owner_id }} added a new publication</p>
		@elseif ($item->subclass == "news")
		  <p style="">Latest news in {{ implode(', ', $item->divisions()) }}</p>
		@elseif ($item->subclass == "other")
		  <P>etc.</P>
		@endif

		@include('frontend.__content-card')
	@endif

	@if(isset($contents))
		@foreach($contents as $index => $item)
			@include('frontend.__content-teaser')
		@endforeach
	@endif

</div>
