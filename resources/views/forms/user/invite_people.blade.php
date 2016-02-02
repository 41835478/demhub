
      <div class="modal-body" style="text-align:center;padding-top:60px" id="inviteForm">
        {!! Form::open(['route' => 'invite_others', 'class' => 'omb_loginForm', 'role' => 'form','data-toggle'=>'validator', 'data-delay'=>'1100', 'enctype'=>"multipart/form-data"]) !!}
        <div class="row" id="modal-body-row">

          <h3>Invite Others To DEMHUB</h3>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              {!! Form::input('0.email', '0.email', Input::get('0.email'), ['class' => 'form-control', 'placeholder' => 'Email Address','required','data-error'=> 'Invalid email address']) !!}
            </div>
            <div class="help-block with-errors"></div>
          </div>

        </div>
        <div class="row" style="padding-bottom:10px">
          <a class="btn btn-style-alt" onclick="addInviteForm()">Add Another</a>
        </div>
        <div class="row">
          {!! Form::submit('DONE', ['class' => 'btn btn-lg btn-style-alt btn-block']) !!}
          {!! Form::close() !!}
        </div>
      </div>


<script>
var formCounter=1;
var formHtml='';
function addInviteForm (){
  formHtml='<div class="form-group"><div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span><input name="'+formCounter+'_email" class="form-control" placeholder="Email Address" required data-error="Invalid email address"></div><div class="help-block with-errors"></div></div>';
  $("#modal-body-row").append(formHtml);
  formCounter++;
}
</script>
