<div class = "col-xs-12 col-sm-6 col-md-4">
  <div class="peoplebox">

    <div class="inner-feedsbox" style="text-align:center;">
      <div class="row">
        <div class="col-xs-4" style="padding-top:20px;">
          {!! HTML::image($user->avatar->url('medium'), $user->avatar_file_name, ['class' => "img-circle img-responsive", 'style' => 'max-height:95px;max-width:80px']) !!}
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
        <div class="col-xs-4">
          <h3 style="margin-bottom:0px">{{count($user->followers())}}</h3>
          <p style="color:#999">followers</p>
        </div>
        <div class="col-xs-4">
          <h3 style="margin-bottom:0px">{{count($user->publications())-1}}</h3>
          <p style="color:#999">publications</p>
        </div>
        <div class="col-xs-4" style="padding-top:20px;padding-left:5px;">
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
            }
             else{
              echo strip_tags($description);
            }
          ?>
          </p>
        @endif
      </div>

      <div class="row">

      </div>




      <div style="margin: 0 auto;width:100%; bottom:0px; position:absolute;">
        <div class="form-group">

            @if(!empty($user->division) && strpos($user->division, "|") === false)
                  <p style="color:#999"> {{$user->division}} </p>
            @elseif(!empty($user->division))

              <?php $divisions = $user->divisions(); ?>

              @if(count($divisions) > 2)
                @include('frontend.user.__user-division-color-dropup-foreach')
              @elseif(count($divisions) <3)
                @foreach($divisions as $divSlug => $divName)

                  <img style="width:12px;height:12px;margin-top:-3px;display:inline" src="/images/backgrounds/patterns/alpha_layer.png" class="img-square img-responsive division_{{ $divSlug }}">
                  <span class="division-text_{{$divSlug}}">{{$divName}}</span>
                @endforeach

              @endif
              @else
            @endif

        </div>
      </div>

    </div> <!-- the div that closes the inner-feedsbox -->

  </div> <!-- the div that closes the peoplebox -->
</div>
