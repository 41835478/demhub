<div id="form-part-2"
  @if(Request::url() == url('auth/register'))
    style="display:none"
  @endif
>

  @if(Request::url() == url('auth/register'))
    <div class="alert alert-dismissible" role="alert" style="background-color:#ccc;color:#000;margin: 0 0 15px 0 !important">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      Just a few more details and you're set.
    </div>
  @endif

  <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-folder-close"></i></span>
      {!! Form::input('job_title', 'job_title', Request::url() == url('auth/autoregister') ? Input::get('job_title') : old('job_title'), ['class' => 'form-control', 'placeholder' => 'Job Title','required','id' => 'job_title']) !!}
    </div>
    <div class="help-block with-errors"></div>
  </div>

  <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-building"></i></span>
      {!! Form::input('organization_name', 'organization_name', Request::url() == url('auth/autoregister') ? Input::get('organization_name') : old('organization_name'), ['class' => 'form-control', 'placeholder' => 'Organization/Agency Name','required','id' => 'organization_name']) !!}
    </div>
    <div class="help-block with-errors"></div>
  </div>

  <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-building"></i></span>
      {!! Form::input('location', 'location', Request::url() == url('auth/autoregister') ? Input::get('location') : old('location'), ['class' => 'form-control', 'placeholder' => 'Country/Region/City','required','id' => 'location']) !!}
    </div>
    <div class="help-block with-errors"></div>
  </div>

</div>
