<ul class="list-inline text-center">
	@foreach($cats as $entity)
		<li>{{$entity->category_name}}</li>
	@endforeach
</ul>