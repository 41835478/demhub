@extends('frontend.layouts.master')

@section('content')
  {{-- @include('frontend.user.dashboard.style')
  @include('frontend.navigation._user-dashboard-sidebar') --}}
  @include('frontend.user.dashboard.profile_partials._profile')
  <button data-toggle="modal" data-target="#inviteModal">invite others</button>
@endsection
@section('modal')
  @include('modals._invite_others', compact('user'))
@endsection
