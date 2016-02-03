@extends('frontend.layouts.master')

@section('content')
  <section id="content_wrapper" class="col-md-10 col-md-offset-1" style="margin-top: 60px;">

    <!-- Begin: Content -->
    <div id="content" class="animated fadeIn" style="padding-bottom: 0px;">
      <a type="button" class="btn btn-style-alt" href="{{ route('profiles') }}"><span class="fa fa-users"></span> DEMHUB NETWORK</a>

      <div class="row center-block mt10" style="">

        @foreach($users as $index => $item)
          @include('frontend.card._card')
        @endforeach
      </div>
    </div>
  </section>

@endsection
