@extends('frontend.layouts.master')

@section('content')
  <div class="row" style="padding-top:20px; font-size:0.86em;">
    <div class="col-sm-7" style="background-color:#fff !important;">

      <a type="button" class="btn btn-style-alt" href="{{ url('my_publications') }}">
        <span class="glyphicon glyphicon-folder-close"></span><span style="visibility:hidden">*</span> MY PUBLICATIONS
      </a>

      <div class="col--offset-7" style="display:inline">
        <a type="button" class="btn btn-style-alt" href="{{ URL::to('my_publication/new') }}">CREATE</a>
      </div>

      <div class="publication-list container col-md-offset-1">

        <hr class="style4">
        @if($publications)
          @foreach ($publications as $publication)
            <div class="publication-each">

              <div class="col-md-8">

                <ul>
                  <li>
                    <div class= "col-md-6" style="margin-left:-15px;">{{ $publication->humanReadablePublishDate() }}</div>
                    <div class= "col-md-6 pub-author"><a href="{{ URL::to('profile/' . $publication->owner_id) }}">
                      @if($publication->uploader)
                        {{$publication->uploader->full_name()}}
                      @endif
                    </div>
                  </li>
                  <li class= "pub-title"><a href="{{ URL::to('publication/' . $publication->id . '/view') }}"><h3>{{$publication->title()}}</a></h3></li>
                  <li class="pub-descrip">  <a role="button" data-toggle="collapse" href=".linkpub-{{$publication->id}}" aria-expanded="false" aria-controls="collapseExample">
                    <i class="icon expand_more" style="margin-top:20px;"></i>More</a>
                  </li>
                </ul>

                <div class="collapse linkpub-{{$publication->id}} pub-dropdown">
                  <div class="well">
                    <div class ="pub-descrip-content">{{$publication->description}}</div>

                    <?php $keywords = $publication->keywords() ?>
                    @if(count($keywords) > 1)

                      @include('division.__keyword-dropup-foreach')

                    @elseif(count($keywords) < 5)

                      @foreach($keywords as $key => $keyword)
                        @if ($keyword)
                          <a class="label label-default" style="font-size:82%;margin-right:2px" href="?query_term={{$keyword}}"></a>
                        @endif
                      @endforeach

                    @endif
                  </div>
                </div>

              </div>

              <?php $publicationsDivisions = $publication->divisions(); ?>
              <div class ="col-md-1">
                <div class ="pub-division">
                  @foreach ($publicationsDivisions as $slug => $divName)
                    <a href="">
                      <img src="/images/backgrounds/patterns/alpha_layer.png" class="img-circle img-responsive pub-division-icon division_{{ $slug }}" title = "{{ $divName }}">
                    </a>
                  @endforeach
                </div>
              </div>

              <div class="col-md-3">
                <ul style="margin-top:-15px">
                  <li>

                    @if (isset($publication) && $publication->mainMedia())
                      <a href="{{ $publication->mainMediaUrl() }}" download data-toggle="tooltip" data-placement="top" title="DOWNLOAD">
                        <h4 class="icon file_download"></h4>
                      </a>
                    @endif

                    <a><h4 class="icon assignment" data-toggle="tooltip" data-placement="top" title="PREVIEW"></h4></a>
                    {{-- <a><h4 class="icon report2" data-toggle="tooltip" data-placement="top" title="REPORT"></h4></a> --}}
                  </li>

                  <li>
                    <ul class="icon-container">
                      <li><i class="icon remove_red_eye" data-toggle="tooltip" data-placement="top" title="VIEWS"></i>{{ $publication->views() }}</li>
                      <li><i class="icon add_circle_outline" data-toggle="tooltip" data-placement="top" title="BOOKMARKS"></i>xx</li>
                      <li><i class="icon chat" data-toggle="tooltip" data-placement="top" title="COMMENTS"></i>xx</li>
                    </ul>
                  </li>
                </ul>
              </div>

              <hr class="style1">

            </div> {{-- close .publication-each --}}
          @endforeach
        @endif

      </div>

    </div>
  </div>
@stop
