@extends('frontend.layouts.master')

@section('content')
  {{-- @include('frontend.user.dashboard._navtest') --}}
  @include('frontend.user.dashboard._sidebar')
  @include('frontend.user.dashboard._dash_content')
@endsection
