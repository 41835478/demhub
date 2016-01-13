<section id="content_wrapper" class="col-md-10 col-md-offset-1" style="margin-top: 60px;">

  <!-- Begin: Content -->
  <div id="content" class="animated fadeIn" style="padding-bottom: 0px;">
    <a type="button" class="btn btn-style-alt" href="{{ route('profiles') }}"><span class="fa fa-users"></span> DEMHUB NETWORK</a>
    
    <div class="row center-block mt10" style="">
      <?php $counter=0; ?>
        @foreach($users as $key => $user)
        @if(Auth::user()->is_following($user))
          <?php $counter++; ?>
            <div class="col-xs-12 col-sm-6 col-md-4">
            <div class = "peoplebox">


              <div class ="color-label division_all"></div>
              <div class="inner-feedsbox" style="text-align:center">
                <div class="member" style="margin: 0 auto;width:150px;padding-top:15px">

                  {!! HTML::image($user->avatar->url('medium'), '$user->avatar_file_name', ['class' => "img-rounded img-responsive"]) !!}
                </div>
              <a href="{{ URL::to('profile/' . $user->user_name) }}">
                <h3>  {{$user->first_name}} {{$user->last_name}}  </h3>
              </a>


            <div>
              <p>
                {{$user->job_title}}
              </p>
              <p>
                @if ($user->organization_name)
                  at
                @else
                @endif
                {{$user->organization_name}}
              </p>
              <span style="color:#999">
                {{$user->location}}
              </span>
            </div>

            <div style="margin: 0 auto;width:100%; height:40px; bottom:0px; position:absolute;margin-left:-11px">


                {!! Form::model($user, ['route' => ['unfollow_user', $user->id], 'style' => '', 'role' => 'form', 'method' => 'POST']) !!}
                  {!! Form::token() !!}
                  <button type="submit" class="btn btn-greytone btn-sm" style="margin-left:5px;">
                    <i class="glyphicon glyphicon-ok"></i> UNFOLLOW
                  </button>
                  <a type="button" class="btn btn-style-alt btn-sm" href="mailto:{{$user->email}}?Subject=DEMHUB%20Connection" target="_top">
                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"> Email</span>
                  </a>
                {!! Form::close() !!}



            </div>


            </div>
          </div> <!-- the div that closes the box -->
        </div>
        @elseif($key = sizeof($users) && $counter = 0)
        <?php $counter++; ?>
        <div class="col-xs-12 col-sm-6 col-md-4">
        <h4 style="">You Haven't Followed Anyone yet. </h4>
        <a type="button" class="btn btn-style-alt btn-sm" href="{{url('profiles')}}">
          <span class="fa fa-users" aria-hidden="true"> FIND OTHERS ON THE DEMHUB NETWORK</span>
        </a>
        </div>

        @endif
        @endforeach

      <!-- </div> -->
      </div>
      </div>
    </section>
