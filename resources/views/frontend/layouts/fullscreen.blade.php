@extends('frontend.layouts.master')

@section('content')

  <section class="main text-center" id="home">
    <div class="page">
      <div class="wrapper-in">
        <div class="container">
          @yield('fullscreen-content')
        </div>
      </div>
    </div>
  </section>

@endsection
