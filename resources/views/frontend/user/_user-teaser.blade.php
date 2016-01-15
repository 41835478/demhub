@foreach($users as $user)

  <div class = "col-xs-12 col-sm-8 col-md-8">
    <div class="peoplebox-teaser">

      <div class="inner-feedsbox">
        <div class="col-sm-2">
          <div class="member" style="margin: 0 auto; width:150px;">
            {!! HTML::image($user->avatar->url('medium'), '$user->avatar_file_name', ['class' => "img-circle img-responsive", 'style' => 'max-height:150px;padding-top:15px']) !!}
          </div>
        </div>
        <div class="col-sm-7 col-sm-offset-1" style="text-align:left;">
        <a class="main-blue-color" href="{{ URL::to('profile/' . $user->user_name) }}">
          <h3 style="margin-top:5px">  {{$user->full_name()}}  </h3>
        </a>

        <p class="orange-hover" style="margin-bottom:0px">{{$user->job_title}}
        @if ($user->organization_name)
          <span style="text-transform:lowercase">at</span> {{$user->organization_name}}</p>
        @endif

        <p style="color:#999">
          {{$user->location}}
        </p>

        @if ($user->division)
          <p style="color:#999">{{$user->division}}</p>
        @endif
        </div>
        <div class="col-sm-2" style="text-align:center;">
        <div style="margin: 0 auto; width:100%; height:40px; position:absolute;">
          @if(Auth::user()->is_following($user))
            {!! Form::model($user, ['route' => ['unfollow_user', $user->id], 'style' => '', 'role' => 'form', 'method' => 'POST']) !!}
              {!! Form::token() !!}
              <button type="submit" class="btn btn-greytone btn-sm" style="margin-left:5px;">
                <i class="glyphicon glyphicon-ok"></i> UNFOLLOW
              </button>
              {{-- <a type="button" class="btn btn-style-alt btn-sm" href="mailto:{{$user->email}}?Subject=DEMHUB%20Connection" target="_top">
                <span class="glyphicon glyphicon-envelope" aria-hidden="true"> Email</span>
              </a> --}}
            {!! Form::close() !!}
          @else
            {!! Form::model($user, ['route' => ['follow_user', $user->id], 'style' => '', 'role' => 'form', 'method' => 'POST']) !!}
              {!! Form::token() !!}
              <button type="submit" class="btn btn-style-alt btn-sm" style="margin-left:5px;">
                <i class="glyphicon glyphicon-plus"></i> FOLLOW
              </button>
                {{-- <a type="button" class="btn btn-style-alt btn-sm" href="mailto:{{$user->email}}?Subject=DEMHUB%20Connection" target="_top">
                  <span class="glyphicon glyphicon-envelope" aria-hidden="true"> Email</span>
                </a> --}}
            {!! Form::close() !!}
          @endif

        <div>
          <h3 style="margin-bottom:0px">{{count($user->followers())}}</h3>
          <p style="color:#999">followers</p>
        </div>
        </div>
      </div>
      </div> <!-- the div that closes the inner-feedsbox -->

    </div> <!-- the div that closes the peoplebox -->
  </div>

@endforeach
