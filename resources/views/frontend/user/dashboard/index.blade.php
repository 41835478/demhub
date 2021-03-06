@extends('frontend.layouts.master')

@section('content')
    <section id="content_wrapper" class="col-md-10 col-md-offset-1" style="margin-top: 60px;">

        <!-- Begin: Content -->
        <div id="content" class="animated fadeIn">
            <div class="row center-block mt10" style="text-transform:uppercase">

                {!! Form::model($user, [
                    'route' => 'update_profile', 'files' => true, 'class' => 'form-horizontal',
                    'method' => 'PATCH', 'data-toggle'=>'validator', 'data-delay'=>'1100'
                ]) !!}

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

                    <div id="infoSectionMiddle" class="col-md-4">

                        <div class="form-group">
                            {!! Form::label('name', 'Name', ['class' => 'col-lg-3 control-label','style' => 'font-size:85%']) !!}

                            {{-- <span class="input-group-addon"><i class="fa fa-user"></i></span> --}}
                            <div class="col-lg-8" style="padding-bottom:15px">
                                {!! Form::input('first_name','first_name', $user->first_name, [
                                    'class' => 'form-control', 'placeholder' => 'First Name','required','id' => 'first_name'
                                ]) !!}
                            </div>

                            <div class="col-lg-8 col-lg-offset-3" style="">
                                {!! Form::input('last_name', 'last_name', $user->last_name, [
                                    'class' => 'form-control', 'placeholder' => 'Last Name','required','id' => 'last_name','style' => 'border-radius:4px'
                                ]) !!}
                            </div>

                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('bio', 'Bio', ['class' => 'col-lg-3 control-label','style' => 'font-size:85%']) !!}
                            <div class="col-lg-8">
                                {!! Form::textarea('bio', $user->bio, ['class' => 'form-control','rows'=>"13","maxlength" => '800','style' => 'resize: vertical']) !!}
                            </div>
                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            {{-- TODO : change .my-publication-label to different class --}}
                            {!! Form::label('null', "Division", ['class' => 'col-lg-3 control-label']) !!}
                            <div class="col-sm-6" style='padding-top:8px'>
                                @foreach($divisions as $div)
                                    @if($user->divisions() !== NULL && array_key_exists($div->slug, $user->divisions()))
                                        {!! Form::checkbox("division_{$div->id}", $div->id, true, ['class' => '']) !!}
                                    @else
                                        {!! Form::checkbox("division_{$div->id}", $div->id, false, ['class' => '']) !!}
                                    @endif
                                    <span class="{{ $div->slug }}-font-color" style="text-transform:capitalize">{{$div->name}}</span><br>
                                @endforeach
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
        </div> <!-- End: Content -->

    </section>
@endsection
