
  <div class="peoplebox">
    <?php
      $width = 100;
      if(count($user->division) > 0) {
          $width = 100 / count($user->division);
      }
    ?>

    @if($user->divisions() == NULL && !strpos(Request::url(), "search"))
      @forelse($user->division as $slug => $div)
        <div class="color-label division_{{$slug}} col-xs-6"
            style="width:{{$width}}%; margin:0;"
            data-toggle="headsup" data-placement="top" title="{{$div}}">
        </div>
      @empty
      <div class="color-label division_all" data-toggle="headsup" data-placement="top" title="All Divisions"></div>
      @endforelse
    @elseif($user->divisions() == NULL)
      <div class="color-label division_all" data-toggle="headsup" data-placement="top" title="All Divisions"></div>
    @else
      @foreach($user->divisions() as $slug => $div)
        <div class="color-label division_{{$slug}} col-xs-6"
            style="width:{{$width}}%; margin:0;"
            data-toggle="headsup" data-placement="top" title="{{$div}}">
        </div>
      @endforeach
    @endif

    <div class="inner-peoplebox" style="text-align:center;">
      <div class="row" style="padding-top:20px;">
        {{-- <div class="col-xs-4" style="padding-top:20px;"> --}}
          {!! HTML::image($user->avatar->url('medium'), '$user->avatar_file_name', ['class' => "img-circle img-responsive", 'style' => 'max-height:95px;max-width:80px;margin: 0 auto']) !!}

          {{-- $user->avatar->url('medium'); --}}
        {{-- </div> --}}


        <a class="main-blue-color" href="{{ URL::to('profile/' . $user->user_name) }}">
          <h3>  {{$user->full_name()}}  </h3>
        </a>

        <p class="main-orange" style="margin-bottom:0px;display:inline-block">{{$user->job_title}}</p>
        @if ($user->organization_name)
          <p class="main-orange" style="display:inline-block;"><span style="text-transform:lowercase">at</span> {{$user->organization_name}}</p>
        @endif

        <p class="col-sm-offset-3" style="color:#999">
          {{$user->location}}
        </p>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <h3 style="margin-bottom:0px">{{count($user->followers())}}</h3>
          <p style="color:#999">followers</p>
        </div>
        <div class="col-xs-4">
          <h3 style="margin-bottom:0px">{{count($user->publications())-1}}</h3>
          <p style="color:#999">publications</p>
        </div>
        <div class="col-xs-4" style="padding-top:20px;padding-left:0px;">
          @if(Auth::user()->is_following($user))
            {!! Form::model($user, ['route' => ['unfollow_user', $user->id], 'style' => '', 'role' => 'form', 'method' => 'POST']) !!}
              {!! Form::token() !!}
              <button type="submit" class="btn btn-greytone btn-sm" style="">
                <i class="glyphicon glyphicon-ok"></i><span style="font-size:85%"> UNFOLLOW</span>
              </button>

            {!! Form::close() !!}
          @else
            {!! Form::model($user, ['route' => ['follow_user', $user->id], 'style' => '', 'role' => 'form', 'method' => 'POST']) !!}
              {!! Form::token() !!}
              <button type="submit" class="btn btn-style-alt btn-sm" style="">
                <i class="glyphicon glyphicon-plus"></i> FOLLOW
              </button>
          @endif
          {{-- <a type="button" class="btn btn-style-alt btn-sm" href="mailto:{{$user->email}}?Subject=DEMHUB%20Connection" target="_top">
            <span class="glyphicon glyphicon-envelope" aria-hidden="true"> Email</span>
          </a> --}}
          {!! Form::close() !!}
        </div>
      </div>
      <div class="row">
        @if ($user->bio)

          <p style="color:#999">
          <?php
          $description = $user->bio;

            if (strlen($description) > 205){
              $str = substr($description, 0, 205) . '...';
              echo strip_tags($str);
            } else{
              echo strip_tags($description);
            }
          ?>
          </p>
        @endif
      </div>



    </div> <!-- the div that closes the inner-feedsbox -->

  </div> <!-- the div that closes the peoplebox -->
