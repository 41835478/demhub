@extends('layouts.master')

@section('content')

<div class="row" style="padding-top:100px">
	<div class="col-md-6 col-md-offset-3">
		<h3 style="text-align:center">ADMIN PANEL</h3>
<form class="form-horizontal" enctype="multipart/form-data" method="get" action="auto-login">

    <div class="form-group">
        <label for="name" class="col-sm-3 control-label" style="font-size:110%">Username</label>
        <div class="col-sm-9">
        	<input type="text" name="username" class="form-control" id="username" placeholder="Username">
        </div>

  	</div>
    <div class="form-group">
        <label for="email" class="col-sm-3 control-label" style="font-size:110%">Email</label>
        <div class="col-sm-9">
        	<input type="text" name="email" class="form-control" id="email" placeholder="Email">
        </div>

  	</div>
    <!-- <div class="form-group">

        <label for="inputPassword3" class="col-sm-3 control-label" style="font-size:110%">Password</label>
        <div class="col-sm-9">
        	<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
        </div>
    </div> -->
    <!-- <div class="form-group">
        <div class="col-sm-offset-3 col-sm-10">
              <div class="checkbox">
                <label>
                	<input name="remember" type="checkbox"

                    > Remember me
                </label>
              </div>
        </div>

    </div> -->
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-10">
        	<button id="createUser" name="createUser" type="submit" class="btn btn-default btn-lg btn-style">ACTIVATE USER & SEND EMAIL</button>
			<button id="autoLogin" name="autoLogin" type="submit" class="btn btn-default btn-lg btn-style">AUTO LOGIN</button>
        </div>
    </div>
	<br><br><br>

</form>
</div>
</div>
@endsection('content')
