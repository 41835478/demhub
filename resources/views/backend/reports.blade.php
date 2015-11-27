@extends('backend.layouts.master')

@section('page-header')
    <h1>
		Keyword management
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">{{ trans('strings.here') }}</li>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Reported Articles</h3>
          <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
			<div class="container-fluid text-center text-bold">
				<div class="col-xs-1"> </div>
				<div class="col-xs-1">Article</div>
				<div class="col-xs-3">Reason</div>
				<div class="col-xs-2">Decision</div>
				<div class="col-xs-4">Comments</div>
				<div class="col-xs-1">Actions</div>
			</div>

	        @foreach($items as $item)
		        <form action="{!!route('backend.reports')!!}" method="get">
					<input type="hidden" name="id" value="{{$item->id}}">
		            <div class="container-fluid text-center" style="border-bottom: 1px solid #bbb">

						<div class="col-xs-1" style="padding: 0">
							{{ $item->id }}:
						</div>
			            <div class="col-xs-1" style="padding: 0">
				            <a href="{!!route('backend.articles', array('id'=>$item->article_id))!!}" target="_blank"
				               class="btn btn-sm btn-default">View</a>
			            </div>
			            <div class="col-xs-2" style="padding: 0">
				            {{ $item->reason }}
			            </div>
			            <div class="col-xs-2" style="padding: 0">
				            <select name="result">
					            <option value=""></option>
					            <option value="ignored" @if($item->result == "ignored") selected @endif >
						            Ignore
					            </option>
					            <option value="deleted" @if($item->result == "deleted") selected @endif >
					                Delete
					            </option>
					            <option value="modified" @if($item->result == "ignored") selected @endif >
					                Modify
					            </option>
				            </select>
			            </div>
				        <div class="col-xs-4" style="padding: 0">
					        <input type="text" name="data" value="{{ $item->data }}" style="width: 100%">
				        </div>
						<div class="col-xs-1" style="padding: 0">
							<input class="btn btn-xs btn-success" type="submit" name="submit" value="save">
						</div>
		            </div>
		        </form>
	        @endforeach
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection