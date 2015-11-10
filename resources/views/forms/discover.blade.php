<form class="form-inline">
	<div class="form-group">
		<label for="keyword"><i class="fa fa-search"></i></label>
		<input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keywords, Parts, Description, etc...">
	</div>
	<button type="submit" class="btn btn-default">Search</button>
	{{Form::token()}}
</form>