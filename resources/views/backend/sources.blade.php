@extends('backend.layouts.master')

@section('page-header')
    <h1>
		Source management
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">{{ trans('strings.here') }}</li>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Sources</h3>
          <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
			<div class="container-fluid text-center text-bold">
				<div class="col-xs-1">id</div>
				<div class="col-xs-1">Atrticle type</div>
				<div class="col-xs-1">type</div>
				<div class="col-xs-2">title</div>
				<div class="col-xs-3">url</div>
				<div class="col-xs-2">last checked</div>
				<div class="col-xs-2"></div>
			</div>

			<form action="{!!route('backend.sources')!!}" method="get">
				<input type="hidden" name="id" value="0">
				<div class="container-fluid text-center" style="border-bottom: 1px solid #bbb">
					<div class="col-xs-1">Add:</div>
					<div class="col-xs-1" style="padding: 0 5px;">
						<select name="article_type" style="width: 100%">
							<option value="{{ \App\Http\Controllers\Frontend\ArticleController::typeOther }}">
								Other
							</option>
							<option value="{{ \App\Http\Controllers\Frontend\ArticleController::typeNews }}">
								News
							</option>
							<option value="{{ \App\Http\Controllers\Frontend\ArticleController::typeScientificPaper }}">
								Scientific Paper
							</option>
							<option value="{{ \App\Http\Controllers\Frontend\ArticleController::typePublication }}">
								Publication
							</option>
							<option value="{{ \App\Http\Controllers\Frontend\ArticleController::typePressRelease }}">
								Press Release
							</option>
						</select>
					</div>
					<div class="col-xs-1" style="padding: 0 5px;">
						<input type="text" name="type" value="" style="width: 100%" >
					</div>
					<div class="col-xs-2 " style="padding: 0 5px;">
						<input type="text" name="title" value="" style="width: 100%" >
					</div>
					<div class="col-xs-3 " style="padding: 0 5px;">
						<input type="url" name="url" value="" style="width: 100%" >
					</div>
					<div class="col-xs-2"></div>
					<div class="col-xs-2" style="padding: 0 5px;">
						<input class="btn btn-xs btn-success" type="submit" name="submit" value="save">
					</div>
				</div>
			</form>

	        @foreach($items as $item)
		        <form action="{!!route('backend.sources')!!}" method="get">
					<input type="hidden" name="id" value="{{$item->id}}">
		            <div class="container-fluid text-center" style="border-bottom: 1px solid #bbb">
						<div class="col-xs-1" style="padding: 0 5px;">{{ $item->id }}:</div>
						<div class="col-xs-1" style="padding: 0 5px;">
							<select name="article_type" style="width: 100%">
								<option value="{{ \App\Http\Controllers\Frontend\ArticleController::typeOther }}"
									@if($item->article_type == \App\Http\Controllers\Frontend\ArticleController::typeOther) selected @endif>
										Other
								</option>
								<option value="{{ \App\Http\Controllers\Frontend\ArticleController::typeNews }}"
									@if($item->article_type == \App\Http\Controllers\Frontend\ArticleController::typeNews) selected @endif>
										News
								</option>
								<option value="{{ \App\Http\Controllers\Frontend\ArticleController::typeScientificPaper }}"
									@if($item->article_type == \App\Http\Controllers\Frontend\ArticleController::typeScientificPaper) selected @endif>
										Scientific Paper
								</option>
								<option value="{{ \App\Http\Controllers\Frontend\ArticleController::typePublication }}"
									@if($item->article_type == \App\Http\Controllers\Frontend\ArticleController::typePublication) selected @endif>
										Publication
								</option>
								<option value="{{ \App\Http\Controllers\Frontend\ArticleController::typePressRelease }}"
									@if($item->article_type == \App\Http\Controllers\Frontend\ArticleController::typePressRelease) selected @endif>
										Press Release
								</option>
							</select>
						</div>
						<div class="col-xs-1" style="padding: 0 5px;">
							<input type="text" name="type" value="{{ $item->type }}" style="width: 100%" >
						</div>
						<div class="col-xs-2 " style="padding: 0 5px;">
							<input type="text" name="title" value="{{ $item->title }}" style="width: 100%" >
						</div>
						<div class="col-xs-3 " style="padding: 0 5px;">
							<input type="url" name="url" value="{{ $item->url }}" style="width: 100%" >
						</div>
						<div class="col-xs-2" style="padding: 0 5px;"><h6 style="margin: 5px 0">{{ $item->last_checked_item }}</h6></div>
						<div class="col-xs-2" style="padding: 0 5px;">
							<input class="btn btn-xs btn-success" type="submit" name="submit" value="save">
							<input class="btn btn-xs btn-danger" type="submit" name="submit" value="x">
						</div>
		            </div>
		        </form>
	        @endforeach
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection