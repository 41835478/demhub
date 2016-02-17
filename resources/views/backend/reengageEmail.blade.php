@extends('backend.layouts.master')

@section('page-header')
    <h1>
		Reengagement Email
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">{{ trans('strings.here') }}</li>
@endsection

@section('content')
  <table>
    <tr>
      <th>Name</th>
      <th>Action</th>
    </tr>

    {!! Form::open(['route' => 'backend.reengageEmail', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'get']) !!}
      {!! Form::text('users', 'reengage', ['class' => 'form-control', 'style' => 'display:none']) !!}
      <tr>
        <td>
          All Users
        </td>
        <td>
          <input type="submit" class="btn btn-success btn-xs" value="Send Email Blast" />
        </td>
      </tr>
    {!! Form::close() !!}
  </table>
@endsection
