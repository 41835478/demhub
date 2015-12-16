<section id="content_wrapper" style="margin-top: 60px;">

  <!-- Begin: Content -->
  <div id="content" class="animated fadeIn" style="padding-bottom: 0;">
    <div class="row center-block mt10" style="">

        @foreach($users as $user)


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

            <div style="margin: 0 auto;width:100%; height:40px; bottom:0px; position:absolute;">

               <button type="button" class="btn btn-greytone btn-sm" style="margin-left:5px;"  aria-haspopup="true" aria-expanded="false">
                 <div class="glyphicon glyphicon-plus" aria-hidden="true"> FOLLOW</div>
               </button>

               <a type="button" class="btn btn-style-alt btn-sm" href="mailto:{{$user->email}}?Subject=DEMHUB%20Connection" target="_top">
                 <div class="glyphicon glyphicon-envelope" aria-hidden="true"> Email</div>
               </a>
            </div>


            </div>
          </div> <!-- the div that closes the box -->
        </div>


        @endforeach

      <!-- </div> -->
      </div>
      </div>
    </section>
