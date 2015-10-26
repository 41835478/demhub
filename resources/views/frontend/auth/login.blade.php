@extends('frontend.layouts.master')

@section('content')
<div class="container-fluid">
<div class="row" style="padding:0px;
                                background:url('http://beta.demhub.net/images/backgrounds/dried_earth.jpg')  no-repeat fixed center;
                                -webkit-background-size: cover;
                                -moz-background-size: cover;
                                -o-background-size: cover;
                                background-size: cover;
                                overflow-x:hidden;
								                color:#fff">
  <div class="col-xs-12" style="padding:0px">
    <div class="row" style="padding-top:50px;">
      <div class="col-md-12 text-center">
        <h2 style="font-size:300%">LOGIN</h2>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        {!! Form::open(['url' => 'auth/login', 'class' => 'form-horizontal', 'role' => 'form']) !!}

        <div class="form-group">
            {!! Form::label('email', trans('Email'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-7">
                {!! Form::input('email', 'email', old('email'), ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('password', trans('validation.attributes.password'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-7">
                {!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-7 col-md-offset-4">
                <div class="checkbox">
                    <label>
                        {!! Form::checkbox('remember') !!} {{ trans('labels.remember_me') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-default btn-lg btn-style" style="margin-right:10px">LOGIN</button>

                {!! link_to('password/email', trans('labels.forgot_password'), ['style' => 'color:#60A0FF']) !!}
            </div>
        </div>

        {!! Form::close() !!}

        <div class="row text-center">
            {!! $socialite_links !!}
        </div>

      </div>
    </div>
  </div>
</div>
</div>
@endsection
