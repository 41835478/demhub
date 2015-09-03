
@foreach($cats as $entity)
	<div style="background-color:#{{$entity->bg_color}}; min-height:60px;" class="col-md-2">
		<a style="color:#FFF;" href="{{URL::route('division', array('id' => $entity->id))}}">
			{{str_replace("<br>", " ",$entity->category_name)}}
		</a>
	</div>
@endforeach
