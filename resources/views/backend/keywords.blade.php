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
          <h3 class="box-title">Keywords</h3>
          <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
			<div class="container-fluid text-center text-bold">
				<div class="col-xs-4">Keyword</div>
				<div class="col-xs-5">
					@foreach($divisions as $div)
						<div class="col-xs-2">
							{{ \App\Http\Components\Helpers::truncate($div->slug, 8) }}
						</div>
					@endforeach
				</div>
				<div class="col-xs-1">weight</div>
			</div>

			<form action="{!!route('backend.keywords')!!}" method="get">
				<input type="hidden" name="key_id" value="0">
				<div class="container-fluid text-center" style="border-bottom: 1px solid #bbb">
					<div class="col-xs-1">Add:</div>
					<div class="col-xs-3">
						<input type="text" name="keyword" value="" >
					</div>
					<div class="col-xs-5">
						@foreach($divisions as $div)
						<div class="col-xs-2" style="background-color: #{{ $div->bg_color }}">
							<input type="checkbox" name="div[]" value="{{ $div->id }}" />
						</div>
						@endforeach
					</div>
					<div class="col-xs-1">
						<input type="number" min="-10" max="10" name="weight" value="1" style="width: 40px;">
					</div>
					<div class="col-xs-2">
						<input class="btn btn-xs btn-success" type="submit" name="submit" value="save">
					</div>
				</div>
			</form>

	        @foreach($items as $item)
		        <form action="{!!route('backend.keywords')!!}" method="get">
					<input type="hidden" name="id" value="{{$item->id}}">
		            <div class="container-fluid text-center" style="border-bottom: 1px solid #bbb">
						<div class="col-xs-1">{{ $item->id }}:</div>
						<div class="col-xs-3">
							<input type="text" name="keyword" value="{{ $item->keyword }}" >
						</div>
				        <div class="col-xs-5">
							@foreach($divisions as $div)
								<div class="col-xs-2" style="background-color: #{{ $div->bg_color }}">
									<input type="checkbox" name="div[]" value="{{ $div->id }}"
									@foreach(\App\Http\Components\Helpers::convertDBStringToArray($item->divisions) as $item_div)
										@if($div->id == $item_div)
											checked
										@endif
									@endforeach
									/>
								</div>
							@endforeach
				        </div>
						<div class="col-xs-1">
							<input type="number" name="weight" value="{{ $item->weight }}" style="width: 40px;">
						</div>
						<div class="col-xs-2">
							<input class="btn btn-xs btn-success" type="submit" name="submit" value="save">
							<input class="btn btn-xs btn-danger" type="submit" name="submit" value="x">
						</div>
		            </div>
		        </form>
	        @endforeach
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection