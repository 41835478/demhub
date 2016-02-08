@extends('frontend.layouts.master')

@section('content')
  <section class="row" style="padding-top:0.75%">
    <!-- Begin: Content -->
    <div class="col-sm-offset-1 col-md-offset-3" style="">

      <a type="button" class="btn btn-style-alt" href="{{ route('connections') }}">
        <span class="fa fa-users"></span> MY NETWORK
      </a>

      <div class="row">

        @foreach($users as $index => $item)
          <div class = "col-xs-12 col-sm-8 col-md-8">
            @include('frontend.card._card')
          </div>
        @endforeach

      </div>

    </div>
  </section>
@endsection
