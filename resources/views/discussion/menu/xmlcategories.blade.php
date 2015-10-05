<ul class="list-inline text-center">
	@foreach($categories as $category)
		<span class="badge" style="background:#{{$category->bg_color}}; color:#FFF; padding:1%;">{{$category->category_name}}</span>
	@endforeach
</ul>