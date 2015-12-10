@extends('frontend.layouts.master')

@section('content')
<div class="row">
  <div class="col-sm-8 col-sm-offset-2">
    <div id="publication-update">
      <h2> Recent Update </h2>
      divisions
    </div>

    <div class="publication-list table table-striped">
        <h2> Articles </h2>
        <hr>
        @foreach ($publications as $pub)
          <div class="publication-each">
            <ul>
                <li = "pub-date">{{ date_format(new DateTime($pub['publish_date']), 'j F Y | g:i a') }}
                <li = "pub-author">Bella Samples</li>
                <li = "pub-title"><h3>{{$pub->title}}</h3>
                </li>
              </li = "pub-descrp">{{$pub->description}}
                <li>
                </li>
            </ul>
            <hr>
              </div>
          @endforeach

    </div>
  </div>
</div>
@stop
{{-- @stop --}}
