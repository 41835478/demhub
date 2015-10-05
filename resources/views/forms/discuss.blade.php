<form class="form" method="post" enctype="multipart/form-data"  action="{{url('post-discussion')}}">
	<div class="form-group">
		<label for="title">Conversation Title</label>
		<input type="text" class="form-control" name="title" id="keyword" placeholder="Emergency...max 200 characters">
	</div>
	<div class="form-group">
		<label for="description">Conversation Paragraph</label>
		<textarea class="form-control" name="description" rows ="7" placeholder="Emergency is..."></textarea>
	</div>
	<div class="form-group">
		<label for="cateogry">Please Pick a Category</label>
		<select name="category" class="form-control">
			@foreach($categories as $category)
				<option value="{{$category->id}}">{{str_replace("<br>", " ", $category->category_name);}}</option>
			@endforeach
		</select>
	</div>
	<hr>
	<button type="submit" class="btn btn-default">Submit</button>
	{!! Form::token() !!}
</form>