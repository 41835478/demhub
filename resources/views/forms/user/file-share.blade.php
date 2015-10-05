<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{url('share', array('id' => $file->id))}}">

  <div class="form-group">
    <label for="fileshare-cetagory">Share File with</label>
    <select class="form-control" name="fileshare-category">
    	@foreach($cats as $cat)
    		<option value="{{$cat->id}}">{{str_replace("<br>", " ", $cat->category_name)}}</option>
    	@endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="fileshare-title">Title</label>
    <input type="text" class="form-control" name="fileshare-title" placeholder="Please provide your file share a title" />
  </div>
  <div class="form-group">
    <label for="fileshare-desc">Description</label>
    <textarea name="fileshare-desc" class="form-control" rows="3" placeholder="Please provide a description about your file...max 150 characters"></textarea>
  </div>
  <div class="form-group">
    <label for="fileshare-keywords">Keywords</label>
    <textarea name="fileshare-keywords" class="form-control" rows="1" placeholder="Emergency;Plan;Evacuation;..." ></textarea>
  </div>
  <div class="form-group">
    <button type="submit"  class="btn btn-default">Submit</button>
  </div>
  {!! Form::token() !!}
</form>