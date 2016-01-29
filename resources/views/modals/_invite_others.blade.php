<div class="modal fade" id="inviteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="text-align:center">
        <h3 style="display:inline">Invite Others</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="text-align:center">
        {!! Form::open(['route' => 'invite_others', 'class' => 'omb_loginForm', 'role' => 'form','data-toggle'=>'validator', 'data-delay'=>'1100', 'enctype'=>"multipart/form-data"]) !!}
        <div class="row">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <div class="col-xs-6" style="padding:0px">
                {!! Form::input('first_name','first_name', Input::get('user.first_name'), ['class' => 'form-control', 'placeholder' => 'First Name','required','id' => 'first_name']) !!}
              </div>
              <div class="col-xs-6" style="padding:0px">
                {!! Form::input('last_name', 'last_name', Input::get('user.last_name'), ['class' => 'form-control', 'placeholder' => 'Last Name','required','id' => 'last_name']) !!}
              </div>
            </div>
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              {!! Form::input('email', 'email', Input::get('user.email'), ['class' => 'form-control', 'placeholder' => 'Email Address','required','data-error'=> 'Invalid email address','id' => 'email']) !!}
            </div>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <div class="col-xs-6" style="padding:0px">
                {!! Form::input('first_name','first_name', Input::get('user.first_name'), ['class' => 'form-control', 'placeholder' => 'First Name','required','id' => 'first_name']) !!}
              </div>
              <div class="col-xs-6" style="padding:0px">
                {!! Form::input('last_name', 'last_name', Input::get('user.last_name'), ['class' => 'form-control', 'placeholder' => 'Last Name','required','id' => 'last_name']) !!}
              </div>
            </div>
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              {!! Form::input('email', 'email', Input::get('user.1.email'), ['class' => 'form-control', 'placeholder' => 'Email Address','required','data-error'=> 'Invalid email address','id' => 'email']) !!}
            </div>
            <div class="help-block with-errors"></div>
          </div>

        </div>
        <div class="row">
          {!! Form::submit('DONE', ['class' => 'btn btn-lg btn-style-alt btn-block']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
