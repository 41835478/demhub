@extends('backend.layouts.master')

@section('page-header')
    <h1>
		Article management
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">{{ trans('strings.here') }}</li>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">
			  Articles
			  <small>
				  Page:
				  @for($i=0; $i<5; $i++)
				  <a href="{!!route('backend.articles', array('page'=>($i+1)))!!}">{{$i+1}}</a> -
				  @endfor
			  </small>
		  </h3>
          <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
			<div class="container-fluid text-center text-bold">
				<div class="col-xs-2">Type</div>
				<div class="col-xs-1">Divisions</div>
				<div class="col-xs-4">Title</div>
				<div class="col-xs-1">Language</div>
				<div class="col-xs-2">Location</div>
				<div class="col-xs-2">Actions</div>
			</div>

	        @foreach($items as $item)
		        <form action="{!!route('backend.articles')!!}" method="get">
					<input type="hidden" name="id" value="{{$item->id}}">
		            <div class="container-fluid text-center" style="border-bottom: 1px solid #bbb">

						<div class="col-xs-2" style="padding: 0">
							<div class="col-xs-2" style="padding: 0">
								{{ $item->id }}:
							</div>
							<div class="col-xs-10" style="padding: 0">
								<select name="type">
									<option value="{{ \App\Http\Controllers\Frontend\ArticleController::typeNews }}"
									@if($item->type == \App\Http\Controllers\Frontend\ArticleController::typeNews) selected @endif >
										News
									</option>
									<option value="{{ \App\Http\Controllers\Frontend\ArticleController::typeScientificPaper }}"
									@if($item->type == \App\Http\Controllers\Frontend\ArticleController::typeScientificPaper) selected @endif >
										Scien. Paper
									</option>
									<option value="{{ \App\Http\Controllers\Frontend\ArticleController::typePublication }}"
									@if($item->type == \App\Http\Controllers\Frontend\ArticleController::typePublication) selected @endif >
										Publication
									</option>
									<option value="{{ \App\Http\Controllers\Frontend\ArticleController::typeOther }}"
									@if($item->type == \App\Http\Controllers\Frontend\ArticleController::typeOther) selected @endif >
										Other
									</option>
								</select>
							</div>
						</div>
				        <div class="col-xs-1" style="padding: 0">
							@foreach($divisions as $div)
								@if(in_array($div->id, \App\Http\Components\Helpers::convertDBStringToArray($item->divisions)))
									<div class="col-xs-3" style="padding:0 5px;background-color: #{{ $div->bg_color }}">
										{{ $div->id }}
									</div>
								@endif
							@endforeach
				        </div>
						<div class="col-xs-4" style="padding: 0">
							<div class="col-xs-10" style="padding: 0">
								<input type="text" name="title" value="{{ $item->title }}" style="width: 100%">
							</div>
							<div class="col-xs-2" style="padding: 0">
								<a href="{{ $item->source_url }}" target="_blank">link</a>
							</div>
						</div>
						<div class="col-xs-1" style="padding: 0">
							{{-- see http://www.landofcode.com/html-reference/language-codes.php for more languages --}}
							<select name="language">
								<option value="" @if($item->language == null) selected @endif ></option>
								<option value="en" @if($item->language == 'en') selected @endif >en</option>
								<option value="fr" @if($item->language == 'fr') selected @endif >fr</option>
								<option value="es" @if($item->language == 'en') selected @endif >es</option>
								<option value="zh" @if($item->language == 'zh') selected @endif >zh</option>
								<option value="ar" @if($item->language == 'ar') selected @endif >ar</option>
								<option value="de" @if($item->language == 'de') selected @endif >de</option>
							</select>
						</div>
						<div class="col-xs-2" style="padding: 0">
							<input type="text" name="location" value="@if($item->country!=null) {{ $item->city }}, {{ $item->state }}, {{ $item->country }}  @endif" style="width: 100%;" >
						</div>
						<div class="col-xs-2" style="padding: 0">
							<input class="btn btn-xs btn-success" type="submit" name="submit" value="save">
							<input class="btn btn-xs btn-danger" type="submit" name="submit" value="x">
						</div>
		            </div>
		        </form>
	        @endforeach
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection
