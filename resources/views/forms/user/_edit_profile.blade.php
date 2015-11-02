<div class="panel panel-default">
  <div class="panel-heading">{{ trans('labels.update_information_box_title') }}</div>

  <div class="panel-body">

    {!! Form::model($user, ['route' => 'update_profile', 'files' => true, 'class' => 'form-horizontal', 'method' => 'PATCH']) !!}

      <div class="col-md-4">

        <div class="form-group">
          {!! Form::label('avatar', 'Avatar', ['class' => 'col-sm-3 control-label']) !!}

          <div class="col-sm-9">
            <img src="{{ $user->avatar->url('') }}" style="height: 200px; max-width: 200px !important;" >

            {!! Form::file('avatar', null, ['class' => 'col-sm-3 control-label']) !!}

            <br><span class="text-primary">JPEGs and PNG accepted.</span>
            <br><span class="text-danger">Max File size: 2MB</span>

          </div>
        </div>

      </div>

      <div class="col-md-4">

        <div class="form-group">
          {!! Form::label('first_name', 'First Name', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-9">
            {!! Form::text('first_name', $user->first_name, ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('last_name', 'Last Name', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-9">
            {!! Form::text('last_name', $user->last_name, ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('user_name', 'Username', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-9">
            {!! Form::text('user_name', $user->user_name, ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('job_title', 'Job Title', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-9">
            {!! Form::text('job_title', $user->job_title, ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('org_agency', 'Organization', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-9">
            {!! Form::text('org_agency', $user->org_agency, ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group">
          <label for="specialization" class="col-sm-3 control-label" style="font-size:105%">Specialization</label>
          <div class="col-sm-9">
            <select class="form-control" name="specialization" id="specialization">
              <option class="active">{{Auth::user()->specialization ? Auth::user()->specialization : "Please select an option"}}</option>
              <option>Emergency Management Practitioner</option>
              <option>Science/Research</option>
              <option>Academic</option>
              <option>Health</option>
              <option>Government</option>
              <option>CBO/NGO</option>
              <option>Administrative/Association Management</option>
              <option>Consultant/Vendor</option>
              <option>Security/Corporate Health and Safety</option>
              <option>Student</option>
              <option>Response</option>
              <option>Business Continutity</option>
              <option>Critical Infrustructure </option>
              <option>Communications</option>
            </select>
         </div>
        </div>

      </div>

      <div class="col-md-4">

        <div class="form-group">
          {!! Form::label('phone_number', 'Phone Number', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-9">
            {!! Form::text('phone_number', $user->phone_number, ['class' => 'form-control']) !!}
          </div>
        </div>

        @if ($user->canChangeEmail())
            <div class="form-group">
                {!! Form::label('email', trans('validation.attributes.email'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::input('email', 'email', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        @endif

        <div class="form-group" style="visibility:hidden">
          <label for="inputLinkedIn" class="col-sm-3 control-label">LinkedIn</label>
          <div class="col-sm-9">
            <input type="text" name="linkedIn" class="form-control" id="inputLinkedIn" placeholder="ca.linkedin.com/in/..." >
          </div>
        </div>

      </div>

      <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
              {!! Form::submit(trans('labels.save_button'), ['class' => 'btn btn-primary']) !!}
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
