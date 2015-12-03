{!! Form::open(['to' => 'auth/register', 'class' => 'omb_loginForm', 'role' => 'form','data-toggle'=>'validator', 'data-delay'=>'1100']) !!}

  <div class="omb_login">

		<div class="row omb_row-sm-offset-3">
      @include('forms.auth.__register_part_one')
      @include('forms.auth.__register_part_two')

      {!! Form::submit('DONE', ['class' => 'btn btn-lg btn-style-alt btn-block']) !!}
    </div>
    <br>

    <!-- <div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-3">
				<label class="checkbox">
          {!! Form::checkbox('remember') !!} {{ trans('labels.remember_me') }}
				</label>
			</div>
		</div> -->

    <div class="form-group">
      <div class="col-md-12 control">
        Already a member?
        <a href="{{url('auth/login')}}" style="color:#60A0FF">
        Login Here
        </a>
      </div>
    </div>

	</div>

{!! Form::close() !!}
