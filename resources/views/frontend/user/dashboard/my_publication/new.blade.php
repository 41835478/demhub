@extends('frontend.layouts.master')

@section('content')
@include('frontend.user.dashboard.style')
@include('frontend.navigation._user-dashboard-sidebar')
<section id="content_wrapper" style="margin-top: 60px;">

  <!-- Begin: Content -->
  <div id="content" class="animated fadeIn" style="padding-bottom: 0;">
    <div class="row center-block mt10" style="">
        <div class="panel panel-default" style="padding-bottom:25%">
          <div class="col-sm-10 col-sm-offset-3">
  <h1>Create a Publication</h1>

  <!-- if there are creation errors, they will show here -->
  {!! HTML::ul($errors->all()) !!}

  {!! Form::open(['route' => 'store_publication', 'files' => true, 'class' => 'form-horizontal', 'method' => 'POST']) !!}
    @include('frontend.user.dashboard.my_publication._form')
  {!! Form::close() !!}
          </div>
        </div>
    </div>
</section>

@endsection
