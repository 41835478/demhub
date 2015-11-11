@extends('frontend.layouts.fullscreen')

@section('body-class')js-fullheight-body @endsection
@section('container-class')fullheight-div @endsection

@section('body-style')
	<style>
		body {
			padding-top: 0px !important;
		}
	</style>
@endsection

@section('fullscreen-content')
	@include('modals._register_prompt')

	<h2> GET THE BETA VERSION</h2>
	{!! Form::open(['to' => 'auth/register', 'class' => 'form-horizontal', 'role' => 'form','data-toggle'=>'validator', 'data-delay'=>'1100' ]) !!}
	  <div id="form-part-1">

	    <div class="form-group">
	      @if ($errors)
	        <span>{{$errors->first('Username')}}</span>
	      @endif
	      <label for="user_name" class="col-sm-4 control-label" style="font-size:110%">Username</label>

	      <div class="col-md-5">
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

	      <div class="col-md-5">
	        {!! Form::input('email', 'email', old('email'), ['class' => 'form-control','required','data-error'=> 'Invalid email address','id' => 'email']) !!}
	      </div>
	      <div class="col-md-5 col-md-offset-4">
	        <div class="help-block with-errors" style="background-color:#fff"></div>
	      </div>
	    </div>

	    <div class="form-group">
	      @if ($errors)
	        <span>{{$errors->first('Password')}}</span>
	      @endif
	      <label for="inputPassword3" class="col-sm-4 control-label" style="font-size:110%">Password</label>

	      <div class="col-md-5">
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

	      <div class="col-md-5">
	        {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control','data-minlength'=>'6']) !!}
	      </div>
	      <div class="col-md-7 col-md-offset-4">
	        <div class="help-block with-errors" style="background-color:#fff"></div>
	      </div>
	    </div>

	    <div class="form-group">
	      <div class="col-sm-offset-3 col-sm-7">
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
	      <div class="col-sm-offset-3 col-sm-7">
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

@endsection
