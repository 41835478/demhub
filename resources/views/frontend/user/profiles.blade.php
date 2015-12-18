@extends('frontend.layouts.master')

@section('content')
  <section id="content_wrapper" style="margin-top: 60px;">
    <!-- Begin: Content -->
    <div id="content" class="animated fadeIn" style="">

      <a type="button" class="btn btn-style-alt col-xs-offset-1" href="{{ route('connections') }}">
        <span class="fa fa-users"></span> MY NETWORK
      </a>

      <div class="row center-block mt10">

        @foreach($users as $user)

          <div class = "col-xs-12 col-sm-6 col-md-4">
            <div class="peoplebox">

              <div class="color-label division_all"></div>
              <div class="inner-feedsbox" style="text-align:center;">
                <div class="member" style="margin: 0 auto; width:150px; padding-top:15px;">
                  {!! HTML::image($user->avatar->url('medium'), '$user->avatar_file_name', ['class' => "img-rounded img-responsive"]) !!}
                </div>

                <a href="{{ URL::to('profile/' . $user->user_name) }}">
                  <h3>  {{$user->first_name}} {{$user->last_name}}  </h3>
                </a>

                <p>{{$user->job_title}}</p>
                @if ($user->organization_name)
                  <p>at {{$user->organization_name}}</p>
                @endif

                <span style="color:#999">
                  {{$user->location}}
                </span>


                <div style="margin: 0 auto; width:100%; height:40px; bottom:0px; position:absolute; margin-left:-11px">
                  @if(Auth::user()->is_following($user))
                    {!! Form::model($user, ['route' => ['unfollow_user', $user->id], 'style' => '', 'role' => 'form', 'method' => 'POST']) !!}
                      {!! Form::token() !!}
                      <button type="submit" class="btn btn-greytone btn-sm" style="margin-left:5px;">
                        <i class="glyphicon glyphicon-ok"></i> UNFOLLOW
                      </button>
                      <a type="button" class="btn btn-style-alt btn-sm" href="mailto:{{$user->email}}?Subject=DEMHUB%20Connection" target="_top">
                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"> Email</span>
                      </a>
                    {!! Form::close() !!}
                  @else
                    {!! Form::model($user, ['route' => ['follow_user', $user->id], 'style' => '', 'role' => 'form', 'method' => 'POST']) !!}
                      {!! Form::token() !!}
                      <button type="submit" class="btn btn-style-alt btn-sm" style="margin-left:5px;">
                        <i class="glyphicon glyphicon-plus"></i> FOLLOW
                      </button>
                      <a type="button" class="btn btn-style-alt btn-sm" href="mailto:{{$user->email}}?Subject=DEMHUB%20Connection" target="_top">
                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"> Email</span>
                      </a>
                    {!! Form::close() !!}
                  @endif
                </div>
              </div> <!-- the div that closes the inner-feedsbox -->

            </div> <!-- the div that closes the peoplebox -->
          </div>

        @endforeach

      </div>

    </div>
  </section>
@endsection
