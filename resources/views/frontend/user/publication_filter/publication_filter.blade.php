@extends('frontend.layouts.master')

@section('content')
<div class="row" style="padding-top:40px">
  <div class="col-sm-8 col-sm-offset-2" style="background-color:#fff !important;">
    <div id="publication-update">
      <h2> Recent Update </h2>

    </div>

    <div class="publication-list">
        <h2> Articles </h2>
        <hr class="style4">
        @if($publications)
        @foreach ($publications as $publication)
          <div class="publication-each">
            <div class="publication-left">
              <ul>
                  <li class= "pub-date">{{ date_format(new DateTime($publication->publication_date), 'j F Y | g:i a') }}
                  <li class= "pub-author"><h5>{{$publication->author->full_name()}}</h5></li>
                  <li class= "pub-title"><h3>{{$publication->title}}</h3></li>
                  <li class="pub-descrip">  <a role="button" data-toggle="collapse" href=".linkpub-{{$publication->id}}" aria-expanded="false" aria-controls="collapseExample">

                  </li>
                  <li> <i class="icon expand_more"></i>description</a></li>
                </ul>
                <div class="collapse linkpub-{{$publication->id}} pub-dropdown" >
                  <div class="well">
                    {{$publication->description}}
                    <?php
                    $articleKeywords = array_filter(preg_split("/\|/", $publication->keywords));
                    ?>

                      @foreach($articleKeywords as $key=>$keyword)

                        <ul class="dropdown-menu label-default" aria-labelledby="dropdownMenu2">
                          <li><a href="?query_term={{$keyword}}">{{$keyword}}</a></li>
                      </ul>

                      @endforeach
                    <div class="label label-default"><h3>{{$publication->keywords}}</h3></div>
                  </div>
                </div>
            </div>
            <div class="publication-right">
              <ul>
                <li>
                  <div class ="division-icon"> {{$publication->divisions}}</div>
                </li>

                <li>
                  <ul class="icon-container">
                    <li><a class="greytone" href="{{ $publication->document->url() }}" download style="padding-left:5px"
                  data-toggle="tooltip" data-placement="top" title="DOWNLOAD">
                  <h3 class="glyphicon glyphicon-save" style="margin:0px"></h3></a></li>
                   <li><a class="greytone"><h3 class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="top" title="PREVIEW"></h3></a></li>
                   <li><a class="greytone"><i class="icon report2" data-toggle="tooltip" data-placement="top" title="REPORT"></i></a></li>
                </li>

                <li>
                  <ul class="icon-container">
                    <li><i class="icon remove_red_eye" data-toggle="tooltip" data-placement="top" title="VIEWS"></i>133</li>
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
