@extends('frontend.layouts.master')


@section('content')



    <!-- Begin: Content -->
    <div class="row" style="padding-top:15px;">

      <div class="row">
      <div class="col-sm-offset-3">
      <a type="button" class="btn btn-style-alt" href="{{ route('profiles') }}">
        <span class="fa fa-users"></span> DEMHUB NETWORK
      </a>
      <a type="button" class="btn btn-style-alt" href="{{ route('connections') }}">
        <span class="fa fa-users"></span> MY NETWORK
      </a>
    </div>
  </div>
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <div style="margin-left:13px;margin-right:-14px;">
          <?php $item=$user; ?>
          @include('frontend.card._card')
            </div>
        </div>
    </div>


    <div class="row">

      <div class="col-xs-3 col-sm-2 col-sm-offset-2">
        <div class="box" style="background-color:#fff">
          <div class="">
            <h4>Stats</h4>
            <h3 style="margin-bottom:0px">{{count($user->followers())}}</h3>
            <p style="color:#999">followers</p>
            <h3 style="margin-bottom:0px">{{count($user->discussions())}}</h3>
            <p style="color:#999">discussions</p>
            <h3 style="margin-bottom:0px">{{count($user->publications())}}</h3>
            <p style="color:#999">publications</p>
          </div>
        </div>
      </div>

      <div class="col-xs-9 col-sm-6">
        <div class="box" style="display:block-inline;width:100%;background-color:#fff">
          <h4>Summary</h4>
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
      </div>

    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <div class="box" style="width:100%;background-color:#fff" >
          <h4>Activity Feed</h4>
          <div>
            <ul>
              <li id="publicationsLi" class="under-border"><a href="#publications" onclick="togglePublications()">Publications</a></li>
              <li id="discussionsLi" class="under-border"><a href="#discussions" onclick="toggleDiscussions()">Discussions</a></li>
              <li id="networkLi" class="under-border"><a href="#network" onclick="toggleNetwork()">Network</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">
          <div id="boxList" style="width:100%;margin:10px 15px 5px 15px;padding:15px 20px 5px 20px;" >
            <div id="publicationsList">
              <?php $items=$user->publications;

               ?>
              @foreach($items as $item)
                @include('frontend.card._card')
              @endforeach
            </div>

            <div id="discussionsList">
              <?php $items = json_decode($user->discussions(), true); ?>
              @foreach($items as $item)
                @include('frontend.card._card')
              @endforeach
            </div>

            <div id="networkList">
              <?php $users=$user->following ?>
              @foreach($users as $user)
                @include('frontend.card._card')
              @endforeach
            </div>
        </div>
      </div>
    </div>


</div>

<script>
  $( document ).ready(function() {
    $("#publicationsList").hide();
    $("#networkList").hide();
    $("#discussionsList").hide();

    if ( $('#discussionsList').children().length > 0 ) {
        $("#discussionsList").toggle();
    } else if ($('#networkList').children().length > 0) {
        $("#networkList").toggle();
    } else if ($('#publicationsList').children().length > 0) {
        $("#publicationsList").toggle();
    }
  });
  function togglePublications(){

    $("#publicationsList").toggle();
    $("#publicationsLi").attr('class','active-border');

    $("#networkLi").attr('class','under-border');
    $("#networkList").hide();
    $("#discussionsLi").attr('class','under-border');
    $("#discussionsList").hide()
  }
  function toggleDiscussions(){

    $("#discussionsList").toggle();
    $("#discussionsLi").attr('class','active-border');

    $("#networkLi").attr('class','under-border');
    $("#networkList").hide();
    $("#publicationsLi").attr('class','under-border');
    $("#publicationsList").hide();
  }
  function toggleNetwork(){

    $("#networkList").toggle();
    $("#networkLi").attr('class','active-border');
    $("#publicationsLi").attr('class','under-border');
    $("#publicationsList").hide();
    $("#discussionsLi").attr('class','under-border');
    $("#discussionsList").hide()

  }
</script>
@endsection
