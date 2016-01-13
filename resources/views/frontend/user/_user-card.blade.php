@foreach($users as $user)

  <div class = "col-xs-12 col-sm-6 col-md-4">
    <div class="peoplebox">

      <div class="color-label division_all"></div>
      <div class="inner-feedsbox" style="text-align:center;">
        <div class="row">
        <div class="col-xs-4" style="padding-top:2px;">
          {!! HTML::image('http://www.demhub.net/system/App/Models/Access/User/User/avatars/000/000/012/medium/chimp transparent backgroung.jpg', '$user->avatar_file_name', ['class' => "img-circle img-responsive", 'style' => '']) !!}
          {{-- $user->avatar->url('medium'); --}}
        </div>

        <a class="main-blue-color" href="{{ URL::to('profile/' . $user->user_name) }}">
          <h3>  {{$user->full_name()}}  </h3>
        </a>

        <p class="main-orange" style="margin-bottom:0px">{{$user->job_title}}
        @if ($user->organization_name)
          <span style="text-transform:lowercase">at</span> {{$user->organization_name}}</p>
        @endif

        <p style="color:#999">
          {{$user->location}}
        </p>
        </div>
        @if ($user->bio)
          <p style="color:#999">{{$user->bio}}</p>
        @endif
        @if ($user->division)
          <p style="color:#999">{{$user->division}}</p>
        @endif

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
