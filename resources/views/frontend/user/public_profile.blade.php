@extends('frontend.layouts.master')


@section('content')

<section id="content_wrapper" style="margin-top: 60px;">

  <!-- Begin: Content -->
  <div id="content" class="animated fadeIn" style="">
    <div class="row center-block mt10" style="">
      <a type="button" class="btn btn-style-alt" href="{{ route('connections') }}">YOUR NETWORK</a>
      <div class="col-md-3 col-sm-offset-1">

        <div id="avatarSection" class="form-group">

          <div class="col-lg-8">
            <img src="{{ $user->avatar->url('medium') }}" style="height: 200px; max-width: 200px !important;" >
          </div>
        </div>
      </div>

      <div id="infoSectionMiddle" class="col-md-2" style="">

          <h3>{{$user->first_name}} {{$user->last_name}}</h3>


          <p>{{$user->job_title}}</p>
          <p>{{$user->organization_name}}</p>


          <p>{{$user->specialization}}</p>
          <p>{{$user->location}}</p>
          <p>{{$user->email}}</p>


      </div>



    </div>
  </div>
</section>
@endsection
