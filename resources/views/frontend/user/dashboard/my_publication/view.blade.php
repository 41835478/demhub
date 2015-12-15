@extends('frontend.layouts.master')


@section('content')
@include('frontend.user.dashboard.style')
@include('frontend.navigation._user-dashboard-sidebar')
<section id="content_wrapper" style="margin-top: 60px;">

  <!-- Begin: Content -->
  <div id="content" class="animated fadeIn" style="">
    <div class="row center-block mt10" style="">
        <a type="button" class="btn btn-style-alt col-md-offset-1" href="{{ URL::to('publication_filter') }}">ALL PUBLICATIONS</a>
          <div class="col-sm-offset-6" style="display:inline">
            <a type="button" class="btn btn-style-alt" href="{{ URL::to('my_publication/new') }}">CREATE</a>
          </div>
        <div class="row">
        <table class="table">
          <thead>
            <tr>
              <td>
                <h3 style="text-align:center">{{ $publication->title }}</h3>
              </td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <embed class="col-md-offset-1 img-responsive" src="{{ $publication->document->url() }}"></embed>
              </td>
            </tr>
          </tbody>
        </table>
      </div>


      </div>
    </div>
</section>
@endsection
