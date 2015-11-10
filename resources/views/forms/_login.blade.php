<h2> LOGIN </h2>
{!! Form::open(['url' => 'auth/login', 'class' => 'form-horizontal', 'role' => 'form']) !!}
  <div class ="row">
  	<div class="form-group">
  			{!! Form::label('email', trans('Email'), ['class' => 'col-md-4 control-label']) !!}

  			<div class="col-md-5">
  					{!! Form::input('email', 'email', old('email'), ['class' => 'form-control']) !!}
  			</div>
  	</div>

  	<div class="form-group">
  			{!! Form::label('password', trans('validation.attributes.password'), ['class' => 'col-md-4 control-label']) !!}
  			<div class="col-md-5">
  					{!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
  			</div>
  	</div>

  	<div class="form-group">
  			<div class="col-md-5 col-md-offset-3">
  					<div class="checkbox">
  							<label>
  									{!! Form::checkbox('remember') !!} {{ trans('labels.remember_me') }}
  							</label>
  					</div>
  			</div>
  	</div>

  	<div class="form-group">
  			<div class="col-md-5 col-md-offset-4">
  					<button type="submit" class="btn btn-default btn-lg btn-style" style="margin-right:10px">LOGIN</button>

  					{!! link_to('password/email', trans('labels.forgot_password'), ['style' => 'color:#60A0FF']) !!}
  			</div>
  	</div>
  </div>
{!! Form::close() !!}
