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
			<div class="container-fluid text-center text-bold">
				<div class="col-xs-6">
					@foreach($divisions as $div)
						<div class="col-xs-2">
							{{ $div->slug }}
						</div>
					@endforeach
				</div>
				<div class="col-xs-3">Text</div>
				<div class="col-xs-1">weight</div>
			</div>
	        @foreach($keywords as $item)
		        <form action="{!!route('backend.keywords')!!}" method="get">
					<input type="hidden" name="key_id" value="{{$item->id}}">
		            <div class="container-fluid text-center" style="border-bottom: 1px solid #bbb">
				        <div class="col-xs-6">
							@foreach($divisions as $div)
								<div class="col-xs-2">
									<input type="checkbox" name="div[]" value="{{ $div->id }}"
									@foreach(\App\Http\Components\ScraperComponent::convertDBStringToArray($item->divisions) as $item_div)
										@if($div->id == $item_div)
											checked
										@endif
									@endforeach
									/>
								</div>
							@endforeach
				        </div>
			            <div class="col-xs-3">
							<input type="text" name="keyword" value="{{ $item->keyword }}" >
						</div>
						<div class="col-xs-1">
							<input type="number" name="weight" value="{{ $item->weight }}" style="width: 40px;">
						</div>
						<div class="col-xs-1">
							<input type="submit" name="submit" value="save">
						</div>
		            </div>
		        </form>
	        @endforeach
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection