<section id="content_wrapper" class="col-md-10 col-md-offset-1" style="margin-top: 60px;">

  <!-- Begin: Content -->
  <div id="content" class="animated fadeIn" style="">
    <div class="row center-block mt10" style="text-transform:uppercase">

      {!! Form::model($user, ['route' => 'update_profile', 'files' => true, 'class' => 'form-horizontal', 'method' => 'PATCH']) !!}

        <div class="col-md-4">

          <div id="avatarSection" class="form-group">
            {!! Form::label('avatar', 'Avatar', ['class' => 'col-lg-3 control-label']) !!}
            <div class="col-lg-8">
              <img src="{{ $user->avatar->url('medium') }}" style="height: 200px; max-width: 200px !important;" >

              {!! Form::file('avatar', null, ['class' => 'col-sm-4 control-label']) !!}

              <br><span class="text-primary">JPEGs and PNG accepted.</span>
              <br><span class="text-danger">Max File size: 2MB</span>
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-3">
              <button type="submit" class="btn btn-style-alt">SAVE</button>
            </div>
          </div>

        </div>

        <div id="infoSectionMiddle" class="col-md-4" style="">

          <div class="form-group">
            {!! Form::label('first_name', 'First Name', ['class' => 'col-lg-3 control-label','style' => 'font-size:88%']) !!}
            <div class="col-lg-8">
              {!! Form::text('first_name', $user->first_name, ['class' => 'form-control']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('last_name', 'Last Name', ['class' => 'col-lg-3 control-label','style' => 'font-size:88%']) !!}
            <div class="col-lg-8">
              {!! Form::text('last_name', $user->last_name, ['class' => 'form-control']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('bio', 'Bio', ['class' => 'col-lg-3 control-label','style' => 'font-size:85%']) !!}
            <div class="col-lg-8">
              {!! Form::textarea('bio', $user->bio, ['class' => 'form-control']) !!}
            </div>
          </div>


        </div>

        <div class="col-md-4">

          <div class="form-group">
              {!! Form::label(null, "DIVISION", ['class' => 'col-lg-3 control-label']) !!}

              @if(!empty($user->division) && strpos($user->division, "|") === false)
                  <div class="col-lg-8">
                    {!! Form::text('division', $user->division, ['class' => 'form-control']) !!}
                @else
                <div class="col-lg-8" style="padding-top:5px">

                  @if (! empty($user->division))

                    @if (strpos($user->division, "health")===false)
                      {!! Form::checkbox('division_1', 'health', false) !!}
                    @else
                      {!! Form::checkbox('division_1', 'health', ['class' => 'form-control']) !!}
                    @endif
                    <span style="color:#0D8E56;">Health & Epidemics</span><br>

                    @if (strpos($user->division, "science")===false)
                      {!! Form::checkbox('division_2', 'science', false) !!}
                    @else
                      {!! Form::checkbox('division_2', 'science', ['class' => 'form-control']) !!}
                    @endif
                    <span style="color:#1D73A3">Science & Environment</span><br>

                    @if (strpos($user->division, "response")===false)
                      {!! Form::checkbox('division_3','response', false) !!}
                    @else
                      {!! Form::checkbox('division_3', 'response', ['class' => 'form-control']) !!}
                    @endif
                    <span style="color:#DB9421">EM Practitioner & Response</span><br>

                    @if (strpos($user->division, "security")===false)
                      {!! Form::checkbox('division_4', 'security', false) !!}
                    @else
                      {!! Form::checkbox('division_4', 'security', ['class' => 'form-control']) !!}
                    @endif
                    <span style="color:#848889">Civil & Cyber Security</span><br>

                    @if (strpos($user->division, 'continuity')===false)
                      {!! Form::checkbox('division_5', 'continuity', false) !!}
                    @else
                      {!! Form::checkbox('division_5', 'continuity', ['class' => 'form-control']) !!}
                    @endif
                    <span style="color:#933131">Business Continuity</span><br>

                    @if (strpos($user->division, 'humanitarian')===false)
                      {!! Form::checkbox('division_6', 'humanitarian', false) !!}
                    @else
                      {!! Form::checkbox('divisio_6', 'humanitarian', ['class' => 'form-control']) !!}
                    @endif
                    <span style="color:#754293">NGO & Humanitarian</span><br>
                  @else
                    {!! Form::checkbox('division_1', 'health', ['class' => 'form-control']) !!}
                    <span style="color:#0D8E56;">Health & Epidemics</span><br>
                    {!! Form::checkbox('division_2', 'science', ['class' => 'form-control']) !!}
                    <span style="color:#1D73A3">Science & Environment</span><br>
                    {!! Form::checkbox('division_3', 'response', ['class' => 'form-control']) !!}
                    <span style="color:#DB9421">EM Practitioner & Response</span><br>
                    {!! Form::checkbox('division_4', 'security', ['class' => 'form-control']) !!}
                    <span style="color:#848889">Civil & Cyber Security</span><br>
                    {!! Form::checkbox('division_5', 'continuity', ['class' => 'form-control']) !!}
                    <span style="color:#933131">Business Continuity</span><br>
                    {!! Form::checkbox('divisio_6', 'humanitarian', ['class' => 'form-control']) !!}
                    <span style="color:#754293">NGO & Humanitarian</span><br>
                  @endif


                @endif
            </div>
          </div>


          <div class="form-group">
            {!! Form::label('job_title', 'Job Title', ['class' => 'col-lg-3 control-label','style' => 'font-size:88%']) !!}
            <div class="col-lg-8">
              {!! Form::text('job_title', $user->job_title, ['class' => 'form-control']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('organization_name', 'Organization', ['class' => 'col-lg-3 control-label','style' => 'font-size:85%']) !!}
            <div class="col-lg-8">
              {!! Form::text('organization_name', $user->organization_name, ['class' => 'form-control']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('specialization', 'Specialization', ['class' => 'col-lg-3 control-label','style' => 'font-size:81%']) !!}
            <div class="col-lg-8">
              {!! Form::text('specialization', $user->specialization, ['class' => 'form-control']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('location', 'Location', ['class' => 'col-lg-3 control-label']) !!}
            <div class="col-lg-8">
              {!! Form::text('location', $user->location, ['class' => 'form-control']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('phone_number', 'Phone', ['class' => 'col-lg-3 control-label']) !!}
            <div class="col-lg-8">
              {!! Form::text('phone_number', $user->phone_number, ['class' => 'form-control']) !!}
            </div>
          </div>

          @if ($user->canChangeEmail())
            <div class="form-group">
              {!! Form::label('email', trans('validation.attributes.email'), ['class' => 'col-lg-3 control-label']) !!}
              <div class="col-lg-8">
                {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
              </div>
            </div>
          @endif

          {{-- <div class="form-group" style="visibility:hidden">
            <label for="inputLinkedIn" class="col-sm-4 control-label">LinkedIn</label>
            <div class="col-sm-8">
              <input type="text" name="linkedIn" class="form-control" id="inputLinkedIn" placeholder="ca.linkedin.com/in/..." >
            </div>
          </div> --}}

        </div>

      {!! Form::close() !!}

    </div>

  </div>
  <!-- End: Content -->

</section>
