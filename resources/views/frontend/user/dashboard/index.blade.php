@extends('frontend.layouts.master')

@section('content')
  @include('frontend.user.dashboard.style')
  @include('frontend.includes._user-dashboard-sidebar')
  @include('frontend.user.dashboard.profile_partials._profile')

@endsection
