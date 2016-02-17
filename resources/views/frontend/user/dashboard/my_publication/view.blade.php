@extends('frontend.layouts.master')

@section('content')
  <section id="content_wrapper" class="col-md-10 col-md-offset-1" style="margin-top: 60px;">

    <!-- Begin: Content -->
    <div id="content" class="animated fadeIn" style="">
      <div class="row center-block mt10" style="margin-left:-75px">

        <a type="button" class="btn btn-style-alt" href="{{ URL::to('public_journal') }}" style="margin-left:10px">
          <span class="glyphicon glyphicon-folder-close"></span><span style="visibility:hidden">*</span> ALL PUBLICATIONS
        </a>

        @if($publication->mainMedia())
          <div class="col-sm-offset-5" style="display:inline">
            <a type="button" class="btn btn-style-alt" href="{{ $publication->mainMediaUrl() }}">FULL SCREEN</a>
          </div>
        @endif

        <div class="row">

          <div class="col-sm-6">
            <h3 style="text-align:center">{{ $publication->title() }}</h3>
            @if($publication->mainMedia())
              <embed class="img-responsive" src="{{ $publication->mainMediaUrl() }}" style="width:100%;height:500px;max-width:600px;max-height:1000px;"></embed>
            @endif
          </div>

          <div class="col-sm-6" style="padding-right:75px">
            <br></br><br></br>
            @include('frontend.user.dashboard.my_publication._publication_details_listing')
          </div>

        </div>

      </div>
    </div> <!-- End: Content -->

        <div class="row">
          <div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <div class="box" style="width:100%;background-color:#fff" >
              <h4>Activity Feed</h4>
              <div>
                <ul>
                  <li id="publicationsLi" class="under-border"><a href="#publications" onclick="togglePublications()">Related Publications</a></li>
                  <li id="discussionsLi" class="under-border"><a href="#discussions" onclick="toggleDiscussions()">Discussions</a></li>
                  <li id="networkLi" class="under-border"><a href="#network" onclick="toggleNetwork()">Followers</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-8 col-sm-offset-2">
              <div id="boxList" style="width:100%;margin:10px 15px 5px 15px;padding:15px 20px 5px 20px;" >
                  <div id="discussionsList">
                    <?php $items = $publication->contents_relation_data('publication','thread'); ?>
                    @if($items)
                        @foreach($items as $item)
                          @include('frontend.card._card')
                        @endforeach
                    @endif
                  </div>

                <div id="publicationsList">

                </div>



                <div id="networkList">
                    <?php $items = $publication->contents_relation_data('publication','user'); ?>
                    @if($items)
                        @foreach($items as $item)
                          @include('frontend.card._card')
                        @endforeach
                    @endif
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
  </section>
@endsection
