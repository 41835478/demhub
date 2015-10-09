<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{$action}}">
 <div class="form-group">
 	@if($errors)
        <span>{{$errors->first('name')}}</span>
    @endif
    <label for="name" class="col-sm-2 control-label">App name</label>
    <div class="col-sm-10">
      <input type="text" name="name" class="form-control" id="name" placeholder="Name"
      @if (Input::old('name'))
      	value = "{{Input::old('name')}}"
      @endif
      >
    </div>
  </div>

  <div class="form-group">
    @if($errors)
        <span>{{$errors->first('description')}}</span>
    @endif
    <label for="description" class="col-sm-2 control-label">App Description</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="description" rows="4" placeholder="Description">@if(Input::old('description')){{Input::old('description')}}@endif</textarea>
    </div>
  </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <div class="checkbox">
            <label>
              <input name="public" type="checkbox">Make App public
            </label>
          </div>
        </div>
    </div>

  <div class="form-group">
  	<div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Save</button>
    </div>
  </div>
  {{Form::token()}}
</form>