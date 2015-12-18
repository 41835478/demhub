@extends('frontend.layouts.master')


@section('content')
@include('frontend.user.dashboard.style')

<section id="content_wrapper" style="margin-top: 60px;">

  <!-- Begin: Content -->
  <div id="content" class="animated fadeIn" style="">
    <div class="row center-block mt10" style="">

        <a type="button" class="btn btn-style-alt" href="{{ URL::to('public_journal') }}" style="margin-left:10px">
          <span class="fa fa-briefcase"></span><span style="visibility:hidden">*</span> ALL PUBLICATIONS
        </a>
          <div class="col-sm-offset-5" style="display:inline">
            <a type="button" class="btn btn-style-alt" href="{{ $publication->document->url() }}">FULL SCREEN</a>
          </div>
        <div class="row">
          <div class="col-sm-6">

                <h3 style="text-align:center">{{ $publication->title }}</h3>

                <embed class="" src="{{ $publication->document->url() }}" style="height:175%;height:175%;max-width:600px;max-height:1000px;"></embed>


    </div>


    <div class="col-sm-6">
      <br></br><br></br>
      @include('frontend.user.dashboard.my_publication._publication_details_listing')
    </div>
    </div>

    </div>
    </div>
</section>
@endsection
