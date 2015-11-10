<div class="col-md-9 col-md-offset-1" style="overflow-x:hidden">

  {!! Form::open(['url' => 'divisions/results', 'class' => 'form-horizontal', 'role' => 'form']) !!}

  <div class="form-group">
        {!! Form::label('search', 'Search news', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">
            {!! Form::text('search', (isset($query)) ? $query : NULL, ['class' => 'form-control', 'placeholder' => 'Search news']) !!}
        </div>
    </div><!--form control-->

    <div class="well">
        <div class="pull-right">
            <!-- <input type="submit" class="btn btn-success btn-xs" value="{{ trans('strings.save_button') }}" /> -->
            <input type="submit" class="btn btn-success btn-xs" value="Search" />
        </div>
        <div class="clearfix"></div>
    </div><!--well-->

    <input type="hidden" name="route" value="{{ Request::path() }}">

  {!! Form::close() !!}

</div>
