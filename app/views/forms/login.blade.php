<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{$action}}">
	@if (Session::has('message'))
        <span>{{Session::get('message')}}</span>
    @endif
    <div class="form-group">
        @if ($errors)
            <span>{{$errors->first('Username')}}</span>
        @endif
        <label for="name" class="col-sm-2 control-label">User Name or E-Mail</label>
        <div class="col-sm-10">
        	<input type="text" name="username" class="form-control" id="username" placeholder="User Name or E-Mail"
            @if (Input::old('username'))
                value = "{{Input::old('username')}}"
            @endif
            >
        </div>
  	</div>
    
    <div class="form-group">
        @if ($errors)
            <span>{{$errors->first('Password')}}</span>
        @endif
        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
        	<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                	<input name="remember" type="checkbox"
                     @if (Input::old('remember'))
                       checked
                    @endif
                    > Remember me
                </label>
              </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        	<button type="submit" class="btn btn-default">Log-In</button>
        </div>
    </div>
    {{Form::token()}}
</form>