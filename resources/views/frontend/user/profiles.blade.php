@extends('frontend.layouts.master')

@section('content')
  <section id="content_wrapper" style="margin-top: 60px;">
    <!-- Begin: Content -->
    <div id="content" class="animated fadeIn" style="">

      <a type="button" class="btn btn-style-alt col-xs-offset-1" href="{{ route('connections') }}">
        <span class="fa fa-users"></span> MY NETWORK
      </a>

      <div class="row center-block mt10">

        @include('cards._user-teaser')

      </div>

    </div>
  </section>
@endsection
