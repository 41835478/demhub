@extends('frontend.layouts.master')


@section('content')
{{-- @include('frontend.user.dashboard.style')
@include('frontend.navigation._user-dashboard-sidebar') --}}
@include('modals._publication_preview')
@include('frontend.user.dashboard.my_publication._main_listing')
<script>
$( document ).ready(function(){
  $('#publicationModal').modal('toggle');
});
</script>
@endsection
