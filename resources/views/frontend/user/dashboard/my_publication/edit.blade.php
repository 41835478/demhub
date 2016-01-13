@extends('frontend.layouts.master')

@section('content')
{{-- @include('frontend.user.dashboard.style')
@include('frontend.navigation._user-dashboard-sidebar') --}}
<section id="content_wrapper" style="margin-top: 60px;">

  <!-- Begin: Content -->
  <div id="content" class="animated fadeIn" style="">
    <div class="row center-block mt10" style="">

        <div class="col-sm-10 col-sm-offset-2">
          <h1>EDIT PUBLICATION</h1>

          {!! Form::model($publication, [
            'route' => ['update_publication', $publication->id], 'files' => true, 'class' => 'form-horizontal', 'method' => 'PATCH',
            'data-toggle'=>'validator', 'data-delay'=>'1100', 'role' => 'form']) !!}
            @include('frontend.user.dashboard.my_publication._form')
          {!! Form::close() !!}
        </div>
    </div>
  </div>
</section>
@endsection
