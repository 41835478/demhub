@foreach($users as $user)

  <div class = "col-xs-12 col-sm-6 col-md-4">
    <div class="peoplebox">


      <div class="inner-feedsbox" style="text-align:center;">
        <div class="row">
        <div class="col-xs-4" style="padding-top:20px;">
          {!! HTML::image('http://www.demhub.net/system/App/Models/Access/User/User/avatars/000/000/012/medium/chimp transparent backgroung.jpg', '$user->avatar_file_name', ['class' => "img-circle img-responsive", 'style' => '']) !!}
          {!! HTML::image('http://www.demhub.net/system/App/Models/Access/User/User/avatars/000/000/012/medium/chimp transparent backgroung.jpg', '$user->avatar_file_name', ['class' => "img-circle img-responsive", 'style' => 'visibility:hidden']) !!}
          {{-- $user->avatar->url('medium'); --}}
        </div>

        <a class="main-blue-color" href="{{ URL::to('profile/' . $user->user_name) }}">
          <h3>  {{$user->full_name()}}  </h3>
        </a>

        <p class="main-orange" style="margin-bottom:0px;display:inline-block;text-align:right">{{$user->job_title}}</p>
        @if ($user->organization_name)
          <p class="main-orange" style="display:inline-block;text-align:right"><span style="text-transform:lowercase">at</span> {{$user->organization_name}}</p>
        @endif

        <p class="col-sm-offset-3" style="color:#999">
          {{$user->location}}
        </p>
        </div>

        <div class="row">
        @if ($user->bio)
          <p style="color:#999">{{$user->bio}}</p>
        @endif
      </div>

        <div class="row">
          <div class="form-group">

              @if(!empty($user->division) && strpos($user->division, "|") === false)
                    <p style="color:#999"> {{$user->division}} </p>
              @else

                @if (! empty($user->division))
                <?php
                  $divisions = array_filter(preg_split("/\|/", $user->division));
                ?>

                @foreach($divisions as $index => $division)
                  <img style="width:18px;height:18px;margin-top:-3px;display:inline" src="/images/backgrounds/patterns/alpha_layer.png" class="img-square img-responsive division_{{ $division }}">
                  <span class="division-text_{{$division}}">Health & Epidemics</span><br>
                @endforeach

                  @endif


                @endif

          </div>
        </div>




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
