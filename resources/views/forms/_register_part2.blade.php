{!! Form::open(['to' => 'auth/register', 'class' => 'form-horizontal', 'role' => 'form']) !!}
  <div id="form-part-1">

    <div class="form-group">
      @if ($errors)
        <span>{{$errors->first('Username')}}</span>
      @endif
      <label for="username" class="col-sm-4 control-label" style="font-size:110%">Username</label>

      <div class="col-md-7">
        {!! Form::input('user_name', 'user_name', old('user_name'), ['class' => 'form-control']) !!}
      </div>
    </div>

    <div class="form-group">
      @if ($errors)
        <span>{{$errors->first('Email')}}</span>
      @endif
      <label for="inputEmail3" class="col-sm-4 control-label" style="font-size:110%">Email</label>

      <div class="col-md-7">
        {!! Form::input('email', 'email', old('email'), ['class' => 'form-control']) !!}
      </div>
    </div>

    <div class="form-group">
      @if ($errors)
        <span>{{$errors->first('Password')}}</span>
      @endif
      <label for="inputPassword3" class="col-sm-4 control-label" style="font-size:110%">Password</label>

      <div class="col-md-7">
        {!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
      </div>
    </div>

    <div class="form-group">
      @if ($errors)
        <span>{{$errors->first('Password')}}</span>
      @endif
      <label for="inputPassword3" class="col-sm-4 control-label" style="font-size:110%">Password Confirm</label>

      <div class="col-md-7">
        {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control']) !!}
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

    <div style="visibility:hidden">
      {{Form::token()}}
    </div>

    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-7">
        <button type="button" class="btn btn-default btn-lg btn-style" data-toggle="modal" data-target="#myModal">JOIN</button>
      </div>
    </div>

  </div>

  <div id="form-part-2" style="display:none">
    <div class="form-group">

      <!-- @if ($errors)
          <span>{{$errors->first('Username')}}</span>
      @endif -->

      <label for="firstName" class="col-sm-3 control-label">First Name</label>

      @if ($errors)
        <span>{{$errors->first('firstName')}}</span>
      @endif


      <div class="col-md-7">

        {!! Form::input('first_name', 'first_name', old('first_name'), ['class' => 'form-control']) !!}
      </div>
    </div>

    <div class="form-group">

      <!-- @if ($errors)
          <span>{{$errors->first('Username')}}</span>
      @endif -->
      <label for="lastName" class="col-sm-3 control-label" >Last Name</label>


      @if ($errors)
          <span>{{$errors->first('lastName')}}</span>
      @endif


      <div class="col-md-7">
          {!! Form::input('last_name', 'last_name', old('last_name'), ['class' => 'form-control']) !!}
      </div>
    </div>

    <div class="form-group">

      <!-- @if ($errors)
          <span>{{$errors->first('Username')}}</span>
      @endif -->
      <label for="jobtitle" class="col-sm-3 control-label" >Job Title</label>

      @if ($errors)
        <span>{{$errors->first('jobTitle')}}</span>
      @endif


      <div class="col-md-7">
        {!! Form::input('job_title', 'job_title', old('job_title'), ['class' => 'form-control']) !!}
      </div>
    </div>

    <div class="form-group">

      <!-- @if ($errors)
          <span>{{$errors->first('Username')}}</span>
      @endif -->
      <label for="Organization/Agency" class="col-sm-3 control-label" >Organization</label>

      @if ($errors)
          <span>{{$errors->first('orgAgency')}}</span>
      @endif


      <div class="col-md-7">
        {!! Form::input('organization_name', 'organization_name', old('organization_name'), ['class' => 'form-control']) !!}
      </div>
    </div>

    <div class="form-group">

      <!-- @if ($errors)
          <span>{{$errors->first('Username')}}</span>
      @endif -->
      <label for="phone" class="col-sm-3 control-label" >Phone Number</label>

      @if ($errors)
          <span>{{$errors->first('phoneNumber')}}</span>
      @endif


      <div class="col-md-7">
          {!! Form::input('phone_number', 'phone_number', old('phone_number'), ['class' => 'form-control']) !!}
      </div>
    </div>

    <div class="form-group">

      <!-- @if ($errors)
          <span>{{$errors->first('Username')}}</span>
      @endif -->
      <label for="specialization" class="col-sm-3 control-label" >Specialization</label>

      @if ($errors)
          <span>{{$errors->first('specialization')}}</span>
      @endif


      <div class="col-md-7">
          {!! Form::select('specialization', array('Emergency Management Practitioner' => 'Emergency Management Practitioner',
          'Science' => 'Science', 'Academic' => 'Academic', 'Health' => 'Health', 'Government' => 'Government', 'CBO/NG' => 'CBO/NGO',
          'Administrative/Association Management' => 'Administrative/Association Management', 'Consultant/Vendor' => 'Consultant/Vendor',
          'Security/Corporate Health and Safety' => 'Security/Corporate Health and Safety', 'Student' => 'Student', 'Response' => 'Response',
          'Business Continutity' => 'Business Continutity', 'Critical Infrustructure' => 'Critical Infrustructure', 'Communications' =>
          'Communications'), array('class' => 'form-control')) !!}
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
