@extends('frontend.layouts.master')

@section('content')
  @include('frontend.user.dashboard.style')
  @include('frontend.user.dashboard._sidebar')
  @include('frontend.user.dashboard.publication.index')
@endsection
