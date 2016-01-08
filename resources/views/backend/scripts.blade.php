@extends('backend.layouts.master')

@section('page-header')
    <h1>
		    Run Scripts
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">{{ trans('strings.here') }}</li>
@endsection

@section('content')
  <table>
    <tr>
      <th>Script Name</th>
      <th>Action</th>
    </tr>

    @foreach($scripts as $s)
      {!! Form::open(['route' => 'backend.signup', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'get']) !!}
        {!! Form::text('filename', $f, ['class' => 'form-control', 'style' => 'display:none']) !!}
        <tr>
          <td>
            Batch #
            <?php
              $output_array = [];
              preg_match("/(\w+)\.csv/", $f, $output_array);
              echo $output_array[1];
            ?>
          </td>
          <td>
            <input type="submit" class="btn btn-success btn-xs" value="Run" />
          </td>
        </tr>
      {!! Form::close() !!}
    @endforeach
  </table>
@endsection
