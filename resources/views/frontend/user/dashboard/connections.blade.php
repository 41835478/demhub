@extends('frontend.layouts.master')

@section('content')
  <section class="row">

    <!-- Begin: Content -->
    <div class="col-sm-offset-2">
      <a type="button" class="btn btn-style-alt" href="{{ route('profiles') }}"><span class="fa fa-users"></span> DEMHUB NETWORK</a>

      <div class="row" style="">

        @foreach($users as $index => $item)
          @include('frontend.card._card')
        @endforeach
      </div>
    </div>
  </section>

@endsection
