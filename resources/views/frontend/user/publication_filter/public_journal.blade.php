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



    </div>
  </div>
  <div>
    @include('frontend._content-teaser')
  </div>
@stop
