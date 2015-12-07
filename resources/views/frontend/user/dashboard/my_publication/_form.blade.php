<div class="form-group">
      {!! Form::label('title', "TITLE", ['class' => 'col-md-1 control-label', 'style' => 'background-color:#ccc;text-align:center;padding-bottom:8px']) !!}
      <div class="col-md-6">
          {!! Form::input('text', 'title', null, ['class' => 'form-control']) !!}
      </div>
</div>

<div class="form-group">
      {!! Form::label('description', "DESCRIPTION", ['class' => 'col-md-1 control-label', 'style' => 'background-color:#ccc;text-align:center;padding-bottom:8px']) !!}
      <div class="col-md-6">
          {!! Form::input('description', 'description', null, ['class' => 'form-control']) !!}
      </div>
</div>

<div class="form-group">
      {!! Form::label('document', "DOCUMENT", ['class' => 'col-md-1 control-label','style' => 'background-color:#ccc;text-align:center;padding-bottom:8px']) !!}
      <div class="col-md-6" style='padding-top:8px'>
          {!! Form::file('document', null, ['class' => 'col-sm-3 control-label']) !!}
      </div>
</div>

<div class="form-group">
      {!! Form::label('date', "DATE", ['class' => 'col-md-1 control-label', 'style' => 'background-color:#ccc;text-align:center;padding-bottom:8px']) !!}
      <div class="col-md-6 input-group date" id='datetimepicker1'>
          {!! Form::input('text', 'date', null, ['class' => 'form-control']) !!}
          <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
          </span>
      </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-1">
        {!! Form::submit('SAVE', ['class' => 'btn btn-style-alt']) !!}
    </div>
</div>
<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
</script>
