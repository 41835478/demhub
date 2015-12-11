@extends('frontend.layouts.master')

@section('content')
<div class="row" style="padding-top:40px">
  <div class="col-sm-8 col-sm-offset-2">
    <div id="publication-update">
      <h2> Recent Update </h2>
      divisions
    </div>

    <div class="publication-list table table-striped">
        <h2> Articles </h2>
        <hr>
        @if($publications)
        @for ($i=(sizeof($publications)-1);$i>-1;$i--)
          <div class="publication-each">
            <ul>
                <li = "pub-date">{{ date_format(new DateTime($publications[$i]->publication_date), 'j F Y | g:i a') }}
                <li = "pub-author">{{$publications[$i]->author->full_name()}}</li>
                <li = "pub-title"><h3>{{$publications[$i]->title}}</h3>
                </li>
              </li = "pub-descrp">{{$publications[$i]->description}}
                <li>
                </li>
            </ul>
            <hr>
              </div>
          @endfor
        @endif
    </div>
  </div>
</div>
@stop
{{-- @stop --}}
