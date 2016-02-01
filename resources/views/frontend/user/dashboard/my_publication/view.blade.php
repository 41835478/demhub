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

  </section>
@endsection
