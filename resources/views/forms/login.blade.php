<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{$action}}">
	@if (Session::has('message'))
        <span>{{Session::get('message')}}</span>
    @endif
    <div class="form-group">   
        <label for="name" class="col-sm-3 control-label" style="font-size:110%">Username or Email</label>
        <div class="col-sm-9">
        	<input type="text" name="username" class="form-control" id="username" placeholder="Username or Email"
            @if (Input::old('username'))
                value = "{{Input::old('username')}}"
            @endif
            >
        </div>
        @if ($errors)
            <span>{{$errors->first('Username')}}</span>
        @endif
  	</div>
    
    <div class="form-group">
        
        <label for="inputPassword3" class="col-sm-3 control-label" style="font-size:110%">Password</label>
        <div class="col-sm-9">
        	<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-10">
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
        @if ($errors)
            <span>{{$errors->first('Password')}}</span>
        @endif
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-10">
        	<button type="submit" class="btn btn-default btn-lg btn-style">LOG IN</button>
        </div>
    </div>
	<br><br><br>
    {{Form::token()}}
</form>