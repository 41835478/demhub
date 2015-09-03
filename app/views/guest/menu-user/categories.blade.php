
@foreach($cats as $entity)
<a href="{{URL::route('division', array('id' => $entity->id))}}" style="">
	<div style="background-color:#{{$entity->bg_color}}; min-height:67px;max-height:67px;" class="col-md-2">
		<p style="color:#FFF;">
			{{str_replace("<br>", " ",$entity->category_name)}}
		</p>
	</div>
</a>	
@endforeach
