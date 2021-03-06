{!! Form::open(['url' => 'auth/login', 'class' => 'omb_loginForm', 'role' => 'form']) !!}

  <div class="container">

      <div class="omb_login">

    		<div class="row omb_row-sm-offset-3">
    			<div class="col-xs-12 col-sm-6">
            <a class="btn btn-style-alt btn-block btn-linkedin" href="{{url('auth/login/linkedin')}}" style="font-size: 15px; margin-bottom: 20px;" tabindex="6">
          		<i class="fa fa-linkedin" style="font-size: 1.8em; margin-right: 5px; padding-right: 10px; border-right: 1px solid #ffffff ;"></i>
          		<span style="text-transform: none;">via LinkedIn</span>
          	</a>
          	<h2 class="provider-header-text-or">OR</h2>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              {!! Form::input('email', 'email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email Address']) !!}
            </div>
            <span class="help-block"></span>

            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock"></i></span>
              {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => 'Password']) !!}
            </div>
            <span class="help-block"></span>
            <br>

            {!! Form::submit('LOGIN', ['class' => 'btn btn-lg btn-style-alt btn-block']) !!}

    			</div>
        </div>
        <br>
        <div class="row omb_row-sm-offset-3">
    			<div class="col-xs-12 col-sm-3">
    				<!-- <label class="checkbox">
              {!! Form::checkbox('remember') !!} {{ trans('labels.remember_me') }}
    				</label> -->
            <div class="form-group">
            <div class="control">
            <p>
              {{ trans('strings.no_account_short') }} <a href="{{url('auth/register')}}" style="color:#60A0FF">
              {{ trans('strings.register') }}
              </a></p>
          </div>
    			</div>
        </div>
    			<div class="col-xs-12 col-sm-3">
    				<p>
              {!! link_to('password/email', trans('labels.forgot_password'), ['style'=>'color:#60A0FF']) !!}
    				</p>
    			</div>
    		</div>

  	</div>

  </div>

{!! Form::close() !!}
