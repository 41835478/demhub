<div class="modal fade" id="inviteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="text-align:center">
        <h3 style="display:inline">Invite Others</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="text-align:center">
        {!! Form::open(['route' => 'invite_others', 'class' => 'omb_loginForm', 'role' => 'form','data-toggle'=>'validator', 'data-delay'=>'1100', 'enctype'=>"multipart/form-data"]) !!}
        <div class="row" id="modal-body-row">


          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              {!! Form::input('0.email', '0.email', Input::get('0.email'), ['class' => 'form-control', 'placeholder' => 'Email Address','required','data-error'=> 'Invalid email address']) !!}
            </div>
            <div class="help-block with-errors"></div>
          </div>

        </div>
        <div class="row">
          <a class="btn btn-style-alt" onclick="addInviteForm()">Add Another</a>
        </div>
        <div class="row">
          {!! Form::submit('DONE', ['class' => 'btn btn-lg btn-style-alt btn-block']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
var formCounter=1;
var formHtml='';
function addInviteForm (){
  formHtml='<div class="form-group"><div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span><input name="'+formCounter+'_email" class="form-control" placeholder="Email Address" required data-error="Invalid email address"></div><div class="help-block with-errors"></div></div>';
  $("#modal-body-row").append(formHtml);
  formCounter++;
}
</script>
