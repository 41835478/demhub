@extends('frontend.layouts.master')

@section('content')
  {{-- @include('frontend.user.dashboard.style')
  @include('frontend.navigation._user-dashboard-sidebar') --}}
  @include('frontend.user.dashboard.publication.index')
@endsection
