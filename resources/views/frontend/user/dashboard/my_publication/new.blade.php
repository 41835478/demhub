@extends('frontend.layouts.master')

@section('content')
@include('frontend.user.dashboard.style')
@include('frontend.navigation._user-dashboard-sidebar')
<section id="content_wrapper" style="padding-top: 60px;background-color:#fff">

  <!-- Begin: Content -->
  <div id="content" class="animated fadeIn" style="">
    <div class="row center-block mt10" style="">

          <div class="col-sm-10 col-sm-offset-2">
  <h1>NEW PUBLICATION</h1>

  <!-- if there are creation errors, they will show here -->
  {!! HTML::ul($errors->all()) !!}


    @include('frontend.user.dashboard.my_publication._form')

          </div>

    </div>
</section>

@endsection
