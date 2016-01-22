@extends('frontend.layouts.master')


@section('content')

<section id="content_wrapper" class="" style="margin-top: 60px;">

  <!-- Begin: Content -->
  <div id="content" class="animated fadeIn" style="">
    <a type="button" class="btn btn-style-alt col-xs-offset-1" href="{{ route('profiles') }}"><span class="fa fa-users"></span> DEMHUB NETWORK</a>
    <a type="button" class="btn btn-style-alt" href="{{ route('connections') }}"><span class="fa fa-users"></span> MY NETWORK</a>

    <div class="row" style="padding-top:15px">
      <div class="col-sm-offset-2 col-sm-10" style="">
      @include('frontend.user._user-teaser')
      </div>
    </div>

    </div>
      <div class="row">
        <div class="col-xs-12 col-sm-1 col-md-1 col-sm-offset-2">
          <div class="box">
            <div class="" style="text-align:center">
              <h4>Stats</h4>
              <h3 style="margin-bottom:0px">{{count($user->followers())}}</h3>
              <p style="color:#999">followers</p>

              {{-- <h3 style="margin-bottom:0px">{{count($user->discussions())}}</h3>
              <p style="color:#999">discussions</p> --}}
              <h3 style="margin-bottom:0px">{{count($user->publications())}}</h3>
              <p style="color:#999">publications</p>
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="box" style="display:block-inline;width:100%">
              <h4 style="text-align:center">Summary</h4>
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
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-sm-offset-2">
          <div class="box" style="width:100%">

              <h4 style="text-align:center">Activity Feed</h4>
              <div>
                <ul>
                  <li {{strpos(Request::url(), "#publications")!==false ? 'class="active"' : ''}}><a id="publications" href="#publications" onclick="togglePublications()">Publications</a></li>
                  <li><a id="discussions" href="#discussions" onclick="toggleDiscussions()">Discussions</a></li>
                  <li><a id="publications" href="#publication" onclick="toggleNetwork()">Network</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <script>
          $( document ).ready(function() {
            $("#publicationsList").hide();
            $("#networkList").hide();
          });
          function togglePublications(){
            $("#publicationsList").toggle();
          }
          function toggleNetwork(){
            $("#networkList").toggle();
            $("#toggleNetwork").prop('active');
          }
        </script>
        <div class="row">
          <div class="col-xs-12 col-sm-7 col-md-7 col-sm-offset-2">
              <div id="publicationsList">
                <?php $items=$user->publications ?>
                @foreach($items as $item)
                  @include('frontend.__content-teaser')
                @endforeach
              </div>


              <div id="networkList">
                <?php $users=$user->following ?>
                @foreach($users as $user)
                  @include('frontend.user.__user-teaser')
                @endforeach
              </div>
            </div>
          </div>








  </div>
</section>
@endsection
