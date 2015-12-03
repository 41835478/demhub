@extends('frontend.layouts.master')

@section('content')
  <h1>Create a Publication</h1>

  <!-- if there are creation errors, they will show here -->
  {!! HTML::ul($errors->all()) !!}

  {!! Form::open(['route' => 'store_publication', 'files' => true, 'class' => 'form-horizontal', 'method' => 'POST']) !!}
    @include('frontend.user.dashboard.my_publication._form')
  {!! Form::close() !!}


@endsection
