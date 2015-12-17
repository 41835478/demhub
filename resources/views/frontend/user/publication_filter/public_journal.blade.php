@extends('frontend.layouts.master')

@section('content')
<div class="row" style="padding-top:20px; font-size:0.86em;">
  <div class="col-sm-8 col-sm-offset-2" style="background-color:#fff !important;">
    <a type="button" class="btn btn-style-alt" href="{{ url('my_publications') }}">
      <span class="fa fa-briefcase"></span><span style="visibility:hidden">*</span> MY PUBLICATIONS</a>

    <div class="col-sm-offset-7" style="display:inline">
      <a type="button" class="btn btn-style-alt" href="{{ URL::to('my_publication/new') }}">CREATE</a>
    </div>

    <div class="publication-list">
      {{-- <h3> Articles </h3> --}}
        <hr class="style4">
        @if($publications)
          @foreach ($publications as $publication)
            <div class="publication-each">
              <div class="col-sm-8">
                <ul>
                  <li class= "pub-date">{{ date_format(new DateTime($publication->publication_date), 'j F Y') }}
                  <li class= "pub-author"><a href="{{ URL::to('profile/' . $publication->user_id) }}"><h5>{{$publication->author->full_name()}}</h5></li>
                  <li class= "pub-title"><a href="{{ URL::to('my_publication/' . $publication->id . '/view') }}"><h4>{{$publication->title}}</a></h4></li>
                  <li class="pub-descrip">  <a role="button" data-toggle="collapse" href=".linkpub-{{$publication->id}}" aria-expanded="false" aria-controls="collapseExample">
                  </li>
                  <li> <i class="icon expand_more"></i>More</a></li>
                </ul>
                  <div class="collapse linkpub-{{$publication->id}} pub-dropdown" >
                    <div class="well">
                      <div class ="pub-descrip-content">{{$publication->description}}</div>
                      <?php
                        $articleKeywords = array_filter(preg_split("/\|/", $publication->keywords));
                      ?>
                        @if(count($articleKeywords) > 1)
                          @foreach($articleKeywords as $key=>$keyword)

                            @if($key==1)
                              <a class="label label-default" style="font-size:82%;margin-right:2px" href="/?query_term={{$keyword}}">
                                {{ $keyword }}
                              </a>
                            @elseif($key==2)

                            <div class="dropup" style="display:inline">
                              <a type="button" class="label label-default dropdown-toggle"
                              data-toggle="dropdown" aria-haspopup="true" id="dropdownMenu2" aria-expanded="false"
                              style="font-size:82%;margin-right:2px">
                              and {{count($articleKeywords)}} other keywords
                                <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu label-default" aria-labelledby="dropdownMenu2">
                                <li><a href="?query_term={{$keyword}}">{{$keyword}}</a></li>
                            @elseif($key>2)
                                <li><a href="?query_term={{$keyword}}" >{{$keyword}}</a></li>

                            @endif
                          @endforeach
                          </ul>
                        </div>
                        @elseif(count($articleKeywords) <5)
                          @foreach($articleKeywords as $key=>$keyword)
                            @if ($keyword)

                            <a class="label label-default" style="font-size:82%;margin-right:2px" href="?query_term={{$keyword}}">
                            @if($keyword == "virus")
                            viral
                            @else
                            {{ $keyword }}
                            @endif
                            </a>
                            @endif
                          @endforeach
                        @endif
                      </div>
                    </div>
                  </div>

            <div class="col-sm-4">
              <ul>
                <li class ="pub-division">
                  <?php
                  if ($publication->divisions !=null){
                  $publicationsDivisions = array_filter(preg_split("/\|/", $publication->divisions));
                  }
                  ?>
                  @if (! empty($publicationsDivisions))
                    @foreach ($publicationsDivisions as $publicationsDivision)

                    <a href="{{url('/division/'.$publicationsDivision)}}" >
                    <img src="/images/backgrounds/patterns/alpha_layer.png" class="img-circle img-responsive pub-division-icon division_{{ $publicationsDivision }}" title = "{{ $publicationsDivision }}">
                  </a>
                    @endforeach
                  @endif
                  </li>

              <li>
              <a href="{{ $publication->document->url() }}" download data-toggle="tooltip" data-placement="top" title="DOWNLOAD">
                      <h4 class="icon file_download"></h4></a>
                 <a><h4 class="icon assignment" data-toggle="tooltip" data-placement="top" title="PREVIEW"></h4></a>
                <a><h4 class="icon report2" data-toggle="tooltip" data-placement="top" title="REPORT"></h4></a>
              </li>

                <li>
                  <ul class="icon-container">
                    <li><i class="icon remove_red_eye" data-toggle="tooltip" data-placement="top" title="VIEWS"></i>{{ $publication->views }}</li>
                    <li><i class="icon thumb_up" data-toggle="tooltip" data-placement="top" title="LIKES"></i>34</li>
                    <li><i class="icon chat" data-toggle="tooltip" data-placement="top" title="COMMENTS"></i>21</li>
                  </ul>
                </li>
              </ul>
            </div>
            <hr class="style1">
         </div>
          @endforeach
        @endif
    </div>
  </div>
</div>
@endsection
{{-- @stop --}}
