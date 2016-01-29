@extends('frontend.layouts.master')

@section('content')
<div class="col-xs-12 col-md-offset-3 col-md-6" style="padding-bottom:85px">
  <div class="row" style="padding-top:20px; font-size:0.86em;">
    <div class="col-sm-12" style="background-color:#fff !important;">

      <a type="button" class="btn btn-style-alt" href="{{ url('my_publications') }}">
        <span class="glyphicon glyphicon-folder-close"></span><span style="visibility:hidden">*</span> MY PUBLICATIONS
      </a>

      <div class="col-sm-offset-6 col-md-offset-5" style="display:inline">
        <a type="button" class="btn btn-style-alt" href="{{ URL::to('my_publication/new') }}">CREATE</a>
      </div>



    </div>
  </div>


    @include('frontend._content-teaser')

</div>
@stop
