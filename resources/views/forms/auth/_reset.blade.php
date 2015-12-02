<div class="container">

    <div class="omb_login">

  		<div class="row omb_row-sm-offset-3">
  			<div class="col-xs-12 col-sm-6">

          {!! Form::open(['url' => 'password/reset', 'class' => 'omb_loginForm', 'role' => 'form']) !!}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              {!! Form::input('email', 'email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email Address']) !!}
            </div>

            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock"></i></span>
              {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => 'Password']) !!}
            </div>

            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock"></i></span>
              {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => 'Password Confirmation']) !!}
            </div>
            <br>

            {!! Form::submit(trans('labels.reset_password_button'), ['class' => 'btn btn-lg btn-primary btn-block']) !!}

          {!! Form::close() !!}

  			</div>
      </div>

      <div class="row omb_row-sm-offset-3">
  			<div class="col-xs-12 col-sm-3">
  				<label class="checkbox">
            {!! Form::checkbox('remember') !!} {{ trans('labels.remember_me') }}
  				</label>
  			</div>
  			<div class="col-xs-12 col-sm-3">
  				<p class="omb_forgotPwd">
            {!! link_to('password/email', trans('labels.forgot_password')) !!}
  				</p>
  			</div>
  		</div>

      <div class="row omb_row-sm-offset-3 omb_loginOr">
  			<div class="col-xs-12 col-sm-6">
  				<hr class="omb_hrOr">
  			</div>
  		</div>

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
