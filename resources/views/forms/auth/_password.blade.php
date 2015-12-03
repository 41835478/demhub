<div class="container">

  <div class="omb_login">

		<div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-6">

        {!! Form::open(['url' => 'password/email', 'class' => 'omb_loginForm', 'role' => 'form']) !!}

          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            {!! Form::input('email', 'email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email Address']) !!}
          </div>
          <br>

          {!! Form::submit( strtoupper(trans('labels.send_password_reset_link_button')), ['class' => 'btn btn-lg btn-primary btn-block']) !!}

        {!! Form::close() !!}

			</div>
    </div>
    <br>
    
    <div class="form-group">
      <div class="col-md-12 control">
        {{ trans('strings.no_account') }}
        <a href="{{url('auth/register')}}">
          {{ trans('strings.register') }}
        </a>
      </div>
    </div>

  </div>

</div>
