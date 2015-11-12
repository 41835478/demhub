<div class="panel panel-default">
  <!-- <div class="panel-heading">{{ trans('labels.update_information_box_title') }}</div> -->

  <div class="panel-body">

    {!! Form::model($user, ['route' => 'update_profile', 'files' => true, 'class' => 'form-horizontal', 'method' => 'PATCH']) !!}

      <div class="col-md-4">

        <div id="avatarSection"class="form-group" style="">
          {!! Form::label('avatar', 'Avatar', ['class' => 'col-sm-4 control-label']) !!}

          <div class="col-sm-8">
            <img src="{{ $user->avatar->url('medium') }}" style="height: 200px; max-width: 200px !important;" >

            {!! Form::file('avatar', null, ['class' => 'col-sm-4 control-label']) !!}

            <br><span class="text-primary">JPEGs and PNG accepted.</span>
            <br><span class="text-danger">Max File size: 2MB</span>

          </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-1">
                	<button type="submit" class="btn btn-style-alt">SAVE</button>
            </div>
        </div>

      </div>

      <div id="infoSectionMiddle" class="col-md-4" style="">

        <div class="form-group">
          {!! Form::label('first_name', 'First Name', ['class' => 'col-sm-4 control-label']) !!}
          <div class="col-sm-8">
            {!! Form::text('first_name', $user->first_name, ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('last_name', 'Last Name', ['class' => 'col-sm-4 control-label']) !!}
          <div class="col-sm-8">
            {!! Form::text('last_name', $user->last_name, ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('user_name', 'Username', ['class' => 'col-sm-4 control-label']) !!}
          <div class="col-sm-8">
            {!! Form::text('user_name', $user->user_name, ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('job_title', 'Job Title', ['class' => 'col-sm-4 control-label']) !!}
          <div class="col-sm-8">
            {!! Form::text('job_title', $user->job_title, ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('organization_name', 'Organization', ['class' => 'col-sm-4 control-label']) !!}
          <div class="col-sm-8">
            {!! Form::text('organization_name', $user->organization_name, ['class' => 'form-control']) !!}
          </div>
        </div>

      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label for="division" class="col-sm-4 control-label">Division</label>
          <div class="col-sm-8">
            {!! Form::select('division', array('0' => 'Select One', '1' => 'Health & Epidemics',
            '2' => 'Science & Environment', '3' => 'EM Practitioner & Response', '4' => 'Civil & Cyber Security',
            '5' => 'Business Continuity', '6' => 'NGO & Humanitarian'
            ),'0', array('class' => 'form-control')) !!}
         </div>
        </div>

        <div class="form-group">
          <label for="specialization" class="col-sm-4 control-label" style="font-size:95%">Specialization</label>
          <div class="col-sm-8">
            {!! Form::text('specialization',null, ['class' => 'form-control']) !!}
         </div>
        </div>

        <div class="form-group">
          {!! Form::label('location', 'Location', ['class' => 'col-sm-4 control-label']) !!}
          <div class="col-sm-8">
            {!! Form::text('location', $user->location, ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('phone_number', 'Phone Number', ['class' => 'col-sm-4 control-label','style' => 'font-size:85%']) !!}
          <div class="col-sm-8">
            {!! Form::text('phone_number', $user->phone_number, ['class' => 'form-control']) !!}
          </div>
        </div>


        @if ($user->canChangeEmail())
            <div class="form-group">
                {!! Form::label('email', trans('validation.attributes.email'), ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::input('email', 'email', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        @endif

        <div class="form-group" style="visibility:hidden">
          <label for="inputLinkedIn" class="col-sm-4 control-label">LinkedIn</label>
          <div class="col-sm-8">
            <input type="text" name="linkedIn" class="form-control" id="inputLinkedIn" placeholder="ca.linkedin.com/in/..." >
          </div>
        </div>

      </div>

    {!! Form::close() !!}

  </div><!--panel body-->

</div><!-- panel -->

{{--
<div class="form-group">
      {!! Form::label('name', trans('validation.attributes.name'), ['class' => 'col-md-4 control-label']) !!}
      <div class="col-md-6">
          {!! Form::input('text', 'name', null, ['class' => 'form-control']) !!}
      </div>
</div> --}}
