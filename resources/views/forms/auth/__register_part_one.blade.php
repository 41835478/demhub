<div id="form-part-1">

  <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-user"></i></span>
      <div class="col-xs-6" style="padding:0px">
        {!! Form::input('first_name','first_name', Request::url() == url('auth/autoregister') ? Input::get('first_name') : old('first_name'), ['class' => 'form-control', 'placeholder' => 'First Name','required','id' => 'first_name']) !!}
      </div>
      <div class="col-xs-6" style="padding:0px">
        {!! Form::input('last_name', 'last_name', Request::url() == url('auth/autoregister') ? Input::get('last_name') : old('last_name'), ['class' => 'form-control', 'placeholder' => 'Last Name','required','id' => 'last_name']) !!}
      </div>
    </div>
    <div class="help-block with-errors"></div>
  </div>

  <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-user"></i></span>
      {!! Form::input('email', 'email', Request::url() == url('auth/autoregister') ? Input::get('email') : old('email'), ['class' => 'form-control', 'placeholder' => 'Email Address','required','data-error'=> 'Invalid email address','id' => 'email']) !!}
    </div>
    <div class="help-block with-errors"></div>
  </div>

  <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
      {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => 'Password','data-minlength'=>'6','required','id' => 'password']) !!}
    </div>
    <div class="help-block with-errors"></div>
  </div>

  {!! Form::token() !!}

</div>
