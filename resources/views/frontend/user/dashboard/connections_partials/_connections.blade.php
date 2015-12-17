<section id="content_wrapper" style="margin-top: 60px;">

  <!-- Begin: Content -->
  <div id="content" class="animated fadeIn" style="padding-bottom: 0;">
    <div class="row center-block mt10" style="">

        @foreach($users as $user)


            <div class="col-xs-12 col-sm-6 col-md-4">
            <div class = "feedsbox">


              <div class ="color-label division_all"></div>
              <div class="inner-feedsbox" style="text-align:center;width:250px">

              <a href="{{ URL::to('profile/' . $user->user_name) }}">
                <h3>  {{$user->first_name}} {{$user->last_name}}  </h3>
              </a>
              <p>
                {{$user->job_title}}
              </p>
              <p>
                {{$user->organization_name}}
              </p>
              <img class="img-responsive img-circle" style="width:150px;display:inline" src="{{$user->avatar->url('medium')}}"><span style="visibility:hidden">*</span>
              <!-- <span class="label label-default" style="font-size:82%">

              </span> -->

              <p>
                {{$user->location}}

              </p>

              <div style="width:100%; height:40px; bottom:0px; position:absolute;">

                  <!-- <button type="button" class="btn btn-default btn-style-alt" aria-label="Left Align" data-toggle="popover"
                  data-content="Feed successfully added to your favourite">


          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        </button> -->

        <!-- <button type="button" class="btn btn-default btn-sm" style="margin-left:5px;">
          <div class="glyphicon glyphicon-thumbs-up" aria-hidden="true"> xxx</div>
        </button> -->



              <a type="button" class="btn btn-default btn-style-alt pull-left" href="mailto:{{$user->email}}?Subject=DEMHUB%20Connection" target="_top">
                <div class="glyphicon glyphicon-envelope" aria-hidden="true"> Email</div>
              </a>

              @if(Auth::user()->is_following($user))
                {!! Form::model($user, ['route' => ['unfollow_user', $user->id], 'class' => 'form-horizontal pull-right', 'role' => 'form', 'method' => 'POST']) !!}
                  {!! Form::submit("Unfollow", ['class' => 'btn btn-default btn-style-alt']) !!}
                {!! Form::close() !!}
              @else
                {!! Form::model($user, ['route' => ['follow_user', $user->id], 'class' => 'form-horizontal pull-right', 'role' => 'form', 'method' => 'POST']) !!}
                  {!! Form::submit("Follow", ['class' => 'btn btn-default btn-style-alt']) !!}
                {!! Form::close() !!}
              @endif



            <!-- <a button type="button" class="btn btn-default btn-sm" style="margin-left:5px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
              <div class="glyphicon glyphicon-comment" aria-hidden="true"> COMMENT</div>
            </button></a>
            <ul class="dropdown-menu" aria-labelledby="dLabel" style="width:100%; heigth:auto; margin-left:-30px; padding: 15px 15px 15px 15px;">
            <li>Place Holder
            </li>
            <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr </p>
            <hr>
            <li>Place Holder
            </li>
            <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr </p>
            <hr>
            <li>Place Holder
            </li>
            <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr </p>
            <hr>

            <div class="form-group">
              <input type="text" class="form-control" placeholder="Comment" style="width:100%; height: 100px;">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>

          </ul> -->

      </div>
            </div>
          </div> <!-- the div that closes the box -->
        </div>


        @endforeach

      <!-- </div> -->
      </div>
      </div>
    </section>
