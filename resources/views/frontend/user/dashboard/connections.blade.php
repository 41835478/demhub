@extends('frontend.layouts.master')

@section('content')
  <section class="row">

    <!-- Begin: Content -->
    <div class="col-sm-offset-1 col-md-offset-2">
      <a type="button" class="btn btn-style-alt" href="{{ route('profiles') }}"><span class="fa fa-users"></span> DEMHUB NETWORK</a>

      <div class="row" style="">

        @foreach($users as $index => $item)
          <div class="col-xs-12 col-sm-6 col-md-4">
          @include('frontend.card._card')
          </div>
        @endforeach

    </div>
  </section>

@endsection
