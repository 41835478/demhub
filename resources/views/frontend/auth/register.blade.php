@extends('frontend.layouts.master')
@section('body-style')
<style>
body {
	padding-top: 0px !important;
}
</style>
@endsection

@section('content')
<div class="row" style="padding:0px;background:url('../images/backgrounds/dried_earth.jpg')  no-repeat fixed center;
																	-webkit-background-size: cover;
																	-moz-background-size: cover;
																	-o-background-size: cover;
																	background-size: cover;
																	color:#fff;
																	padding-bottom:15%
																	">
	<div class="row" style="padding-top:50px;">
    <div class="col-md-12 text-center">

      <h2 style="font-size:300%">GET THE BETA VERSION</h2>
    </div>
	</div>

	<div class="modal fade" id="successModal" style="padding-top:100px">
	  <div class="modal-dialog">
	    <div class="modal-content">

	      <div class="modal-body" style="color:#000">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick=""><span aria-hidden="true">&times;</span></button>
	          <h3>We verify each member who signs up.</h3>
					  <h3>In order to do so DEMHUB needs a few more details.</h3>
						<div class="col-sm-offset-4">
						<a type="button" href="" class="btn btn-default btn-style-alt text-center" data-dismiss="modal" onclick="updateForm()">SOUNDS GOOD
					</a></div>
				</div>
				<!-- <div class="modal-footer">

				<button type="button" class="btn btn-primary">Save changes</button>
				</div> -->
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" id="errorModal" style="padding-top:100px">
	  <div class="modal-dialog">
	    <div class="modal-content">

	      <div class="modal-body" style="color:#000">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick=""><span aria-hidden="true">&times;</span></button>
	          <h4>Please correctly enter values into the registration fields.</h4>

				</div>
				<!-- <div class="modal-footer">

				<button type="button" class="btn btn-primary">Save changes</button>
				</div> -->
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			{!! Form::open(['to' => 'auth/register', 'class' => 'form-horizontal', 'role' => 'form','data-toggle'=>'validator', 'data-delay'=>'1100' ]) !!}
				<div id="form-part-1">

					<div class="form-group">
		    		@if ($errors)
		        	<span>{{$errors->first('Username')}}</span>
		        @endif
		    		<label for="user_name" class="col-sm-4 control-label" style="font-size:110%">Username</label>

		        <div class="col-md-7">
		        	{!! Form::input('user_name','user_name',old('user_name'), ['class' => 'form-control','required','id' => 'user_name']) !!}
		        </div>
						<div class="col-md-7 col-md-offset-4">
							<div class="help-block with-errors" style="background-color:#fff"></div>
						</div>
		  		</div>

					<div class="form-group">
		    		@if ($errors)
		        	<span>{{$errors->first('Email')}}</span>
		        @endif
		        <label for="inputEmail3" class="col-sm-4 control-label" style="font-size:110%">Email</label>

		        <div class="col-md-7">
		        	{!! Form::input('email', 'email', old('email'), ['class' => 'form-control','required','data-error'=> 'Invalid email address','id' => 'email']) !!}
		        </div>
						<div class="col-md-7 col-md-offset-4">
							<div class="help-block with-errors" style="background-color:#fff"></div>
						</div>
		    	</div>

		    	<div class="form-group">
		    		@if ($errors)
		        	<span>{{$errors->first('Password')}}</span>
		        @endif
		        <label for="inputPassword3" class="col-sm-4 control-label" style="font-size:110%">Password</label>

		        <div class="col-md-7">
		        	{!! Form::input('password', 'password', null, ['class' => 'form-control','data-minlength'=>'6','id' =>'password']) !!}
		        </div>
						<div class="col-md-7 col-md-offset-4">
							<div class="help-block with-errors" style="background-color:#fff"></div>
						</div>
		    	</div>

					<div class="form-group">
		    		@if ($errors)
		        	<span>{{$errors->first('Password')}}</span>
		        @endif
		        <label for="inputPassword3" class="col-sm-4 control-label" style="font-size:110%">Password Confirm</label>

		        <div class="col-md-7">
		        	{!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control','data-minlength'=>'6']) !!}
		        </div>
						<div class="col-md-7 col-md-offset-4">
							<div class="help-block with-errors" style="background-color:#fff"></div>
						</div>
		    	</div>

		    	<div class="form-group">
		        <div class="col-sm-offset-4 col-sm-7">
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

						{!! Form::token() !!}

					<div class="form-group">
		        <div class="col-sm-offset-4 col-sm-7">
		        	<a type="button" href="#" class="btn btn-lg btn-default" onclick="pageUpdate()">JOIN</a>
							<button type="button" id="modalSuccessButton" class="btn btn-default" data-toggle="modal" data-target="#successModal" style="display:none">MODAL S</button>
							<button type="button" id="modalErrorButton" class="btn btn-default" data-toggle="modal" data-target="#errorModal" style="display:none">MODAL ERROR</button>
		        </div>
		    	</div>

				</div>

				<div id="form-part-2" style="display:none">
		    	<div class="form-group">

		        <!-- @if ($errors)
		            <span>{{$errors->first('Username')}}</span>
		        @endif -->

						<label for="firstName" class="col-sm-4 control-label">First Name</label>

		        @if ($errors)
		          <span>{{$errors->first('firstName')}}</span>
		        @endif


		        <div class="col-md-7">

		          {!! Form::input('first_name', 'first_name', old('first_name'), ['class' => 'form-control','required']) !!}
		      	</div>
						<div class="col-md-7 col-md-offset-4">
							<div class="help-block with-errors" style="background-color:#fff"></div>
						</div>
					</div>

		    	<div class="form-group">

		        <!-- @if ($errors)
		            <span>{{$errors->first('Username')}}</span>
		        @endif -->
		        <label for="lastName" class="col-sm-4 control-label" >Last Name</label>


		        @if ($errors)
		            <span>{{$errors->first('lastName')}}</span>
		        @endif


		        <div class="col-md-7">
		            {!! Form::input('last_name', 'last_name', old('last_name'), ['class' => 'form-control','required']) !!}
		        </div>
						<div class="col-md-7 col-md-offset-4">
							<div class="help-block with-errors" style="background-color:#fff"></div>
						</div>
					</div>

		    	<div class="form-group">

		        <!-- @if ($errors)
		            <span>{{$errors->first('Username')}}</span>
		        @endif -->
		        <label for="jobtitle" class="col-sm-4 control-label" >Job Title</label>

		        @if ($errors)
		          <span>{{$errors->first('jobTitle')}}</span>
		        @endif


		        <div class="col-md-7">
		          {!! Form::input('job_title', 'job_title', old('job_title'), ['class' => 'form-control','required']) !!}
		        </div>
						<div class="col-md-7 col-md-offset-4">
							<div class="help-block with-errors" style="background-color:#fff"></div>
						</div>
					</div>

		    	<div class="form-group">

		        <!-- @if ($errors)
		            <span>{{$errors->first('Username')}}</span>
		        @endif -->
		        <label for="Organization/Agency" class="col-sm-4 control-label" >Organization</label>

		        @if ($errors)
		            <span>{{$errors->first('orgAgency')}}</span>
		        @endif


		        <div class="col-md-7">
							{!! Form::input('organization_name', 'organization_name', old('organization_name'), ['class' => 'form-control','required']) !!}
		        </div>
						<div class="col-md-7 col-md-offset-4">
							<div class="help-block with-errors" style="background-color:#fff"></div>
						</div>
					</div>



		    	<div class="form-group">
		        <div class="col-sm-3"></div>
		        <div class="col-sm-offset-4 col-sm-7">
		        	<button type="submit" class="btn btn-default btn-lg btn-style">DONE</button>
		        </div>
		    	</div>

				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
<script>
	function pageUpdate(){
		if(!$('#user_name').val() || !$('#email').val() || !$('#password').val()) {
		// $("#sign-up-form").slideUp();
		$('#modalErrorButton').click();
		}
		else {
			$('#modalSuccessButton').click();
		}
	}
	function updateForm(){
		document.getElementById("form-part-1").style.display="none";
		document.getElementById("form-part-2").style.display="";
	}
</script>

@endsection
