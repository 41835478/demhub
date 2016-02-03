@extends('frontend.layouts.master')

@section('content')
  <section class="row">
    <!-- Begin: Content -->
    <div class="col-sm-offset-3" style="">

      <a type="button" class="btn btn-style-alt" href="{{ route('connections') }}">
        <span class="fa fa-users"></span> MY NETWORK
      </a>

      <div class="row">

        @foreach($users as $index => $item)
          @include('frontend.card._card')
        @endforeach

      </div>

    </div>
  </section>
@endsection
