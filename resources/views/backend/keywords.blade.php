@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Laravel 5 Bootstrap
        <small>{{ trans('strings.backend.dashboard_title') }}</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">{{ trans('strings.here') }}</li>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Keyword management</h3>
          <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
	        @foreach($keywords as $item)
		        <form action="" method="get">
		            <div class="container-fluid">
				        <div class="col-xs-4">
					        {{ $item->divisions }}
				        </div>
			            <div class="col-xs-4">{{ $item->keyword }}</div>
		            </div>
		        </form>
	        @endforeach
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection