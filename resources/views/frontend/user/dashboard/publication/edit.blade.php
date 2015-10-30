@extends('frontend.layouts.master')

@section('content')
  <h1>Edit a Publication</h1>

  {!! Form::model($publication, ['route' => 'update_publication', 'files' => true, 'class' => 'form-horizontal', 'method' => 'PATCH']) !!}
    @include('frontend.user.dashboard.publication._form')
  {!! Form::close() !!}
@endsection
