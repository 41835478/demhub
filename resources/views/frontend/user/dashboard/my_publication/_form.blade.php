<div class="form-group">
      {!! Form::label('title', "Title", ['class' => 'col-md-4 control-label']) !!}
      <div class="col-md-6">
          {!! Form::input('text', 'title', null, ['class' => 'form-control']) !!}
      </div>
</div>

<div class="form-group">
      {!! Form::label('description', "Description", ['class' => 'col-md-4 control-label']) !!}
      <div class="col-md-6">
          {!! Form::input('description', 'description', null, ['class' => 'form-control']) !!}
      </div>
</div>

<div class="form-group">
      {!! Form::label('document', "Document", ['class' => 'col-md-4 control-label']) !!}
      <div class="col-md-6">
          {!! Form::file('document', null, ['class' => 'col-sm-3 control-label']) !!}
      </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {!! Form::submit(trans('labels.save_button'), ['class' => 'btn btn-primary']) !!}
    </div>
</div>
