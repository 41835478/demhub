<section id="content_wrapper" style="margin-top: 60px;">

  <!-- Begin: Content -->
  <div id="content" class="animated fadeIn" style="padding-bottom: 0;">
    <div class="row center-block mt10" style="">

        @foreach($users as $user)


            <div class="col-xs-12 col-sm-6 col-md-4">
            <div class = "feedsbox">


              <div class ="color-label division_all"></div>
              <div class="inner-feedsbox" style="text-align:center">
              <div class="row">
              <div class="col-xs-6" >
              <a href="{{ URL::to('profile/' . $user->user_name) }}">
                <h3>  {{$user->first_name}} {{$user->last_name}}  </h3>
              </a>


                <div class="member">

                  {!! HTML::image($user->avatar->url('medium'), '$user->avatar_file_name', ['class' => "mask-medium"]) !!}
                </div>
              <!-- <span class="label label-default" style="font-size:82%">
              </span> -->
            </div>
            <div class="col-xs-6" style="padding-top:50px">
              <p>
                {{$user->job_title}}
              </p>
              <p>
                {{$user->organization_name}}
              </p>
              <p>
                {{$user->location}}
              </p>

            </div>
          </div>

            </div>
          </div> <!-- the div that closes the box -->
        </div>


        @endforeach

      <!-- </div> -->
      </div>
      </div>
    </section>
