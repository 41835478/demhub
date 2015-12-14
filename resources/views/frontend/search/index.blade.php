@extends('frontend.layouts.master')

@section('content')
  <div class="row">
    <div class="col-sm-12 admin-grid">
      @include('frontend.search._article_results')
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 admin-grid">
      @include('frontend.search._user_results')
    </div>

    <div class="col-lg-4 admin-grid">
      @include('frontend.search._publication_results')
    </div>

    <div class="col-lg-4 admin-grid">
      @include('frontend.search._resource_results')
    </div>
  </div>

  {{-- @include('frontend.search._discussion_results') --}}
@stop
