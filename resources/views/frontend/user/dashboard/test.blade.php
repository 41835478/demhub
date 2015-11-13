@extends('frontend.layouts.master')

@section('content')
  {{-- @include('frontend.user.dashboard._navtest') --}}
  @include('frontend.user.dashboard._sidebar')
  {{-- @include('frontend.user.dashboard._dash_content') --}}
  @include('frontend.user.dashboard._dash_content_test')

  {!! HTML::script("js/dashboardtest/utility.js") !!}
  {!! HTML::script("js/dashboardtest/demo.js") !!}
  {!! HTML::script("js/dashboardtest/main.js") !!}

  <script type="text/javascript">
    jQuery(document).ready(function() {

      "use strict";

      // Init Demo JS
      Demo.init();


      // Init Theme Core
      Core.init();

    });
  </script>
@endsection
