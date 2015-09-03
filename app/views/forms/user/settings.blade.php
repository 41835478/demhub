<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{$action}}">
  <div class="form-group">
    <label class="col-sm-2 control-label" for="inputuserImage">Avatar</label>
    <div class="col-sm-10">

      {{HTML::image('images/user/'.$user_avatar->image.'', 
                    ''.Auth::user()->user_name.' icon', 
                    array(
                      'class' => 'user-icon img-responsive img-circle',
                    )
        )}}<br><br>
      <input type="file" name="user_image" id="user_image" placeholder="Browse" value="{{Auth::user()->user_name}}">
      <br>
      <span class="text-primary">JPEGs and PNG accepted.</span>
      <br>
      <span class="text-danger">Max File size: 2MB</span>
    </div>
  </div>
  <div class="form-group">
    <label for="inputuserName" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <input type="text" name="username" class="form-control" id="inputuserName" placeholder="Email" value="{{Auth::user()->user_name}}">
    </div>
  </div>

  <div class="form-group disabled">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" value="{{Auth::user()->user_email}}" disabled>
    </div>
  </div>
  
  <div class="form-group">
  	<div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Save</button>
    </div>
  </div>
  {{Form::token()}}
</form>