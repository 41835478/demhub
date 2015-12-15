
<div id="main_publication_form">
  <div class="form-group">
        {!! Form::label('title', "TITLE", ['class' => 'col-xs-3 col-sm-2 control-label', 'style' => 'background-color:#ccc;text-align:center;padding-bottom:8px']) !!}
        <div class="col-xs col-sm-6">
            {!! Form::input('text', 'title', null, ['class' => 'form-control']) !!}
        </div>
  </div>

  <div class="form-group">
        {!! Form::label('description', "DESCRIPTION", ['class' => 'col-xs-3 col-sm-2 control-label', 'style' => 'background-color:#ccc;text-align:center;padding-bottom:8px']) !!}
        <div class="col-sm-6">
            {!! Form::input('text', 'description', null,
            ['class' => 'form-control ', 'maxlength'=>'255', 'placeholder' => '50 words or less', 'id' => 'description']) !!}
        </div>
        <div class="help-block with-errors"></div>
  </div>

  <div class="form-group">
        {!! Form::label('author', "author", ['class' => 'col-xs-3 col-sm-2 control-label', 'style' => 'background-color:#ccc;text-align:center;padding-bottom:8px;text-transform:uppercase']) !!}
        <div class="col-sm-6">
            {!! Form::input('text', 'publication_author', null, ['class' => 'form-control ', 'maxlength'=>'255']) !!}

        </div>
        <div class="help-block with-errors"></div>
  </div>

  <div class="form-group">
        {!! Form::label('document', "DOCUMENT", ['class' => 'col-xs-3 col-sm-2 control-label','style' => 'background-color:#ccc;text-align:center;padding-bottom:8px']) !!}
        <div class=" col-sm-6"
          @if (empty($publication->document_file_name))
          style='padding-top:8px'>
            {!! Form::file('document', null, ['class' => 'form-control', 'required']) !!}
          @elseif (! empty($publication->document_file_name))
          >
            <input type="text" class="form-control" value="{{$publication->document_file_name}}" disabled/>

          @endif
        </div>
  </div>

  <div class="form-group">
        {!! Form::label('publication_date', "DATE", ['class' => 'col-xs-3 col-sm-2 control-label', 'style' => 'background-color:#ccc;text-align:center;padding-bottom:8px']) !!}
        <div class="col-sm-6 input-group date" id='datetimepicker1' style="padding-left:10px;padding-right:10px">
          <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
          </span>
          @if (empty($publication->publication_date))
            {!! Form::input('publication_date', 'publication_date', null, ['class' => 'form-control','required', 'id' => 'publication_date']) !!}
          @elseif (! empty($publication->publication_date))

            <input type="text" name="publication_date" id="publication_date" class="form-control" value="{{date_format(new DateTime($publication->publication_date ), 'd/m/Y')}}" style="" required/>
          @endif
        </div>
        <div class="help-block with-errors"></div>
  </div>

  <div class="form-group">
        {!! Form::label('privacy', "PRIVACY", ['class' => 'col-xs-3 col-sm-2 control-label','style' => 'background-color:#ccc;text-align:center;padding-bottom:8px']) !!}
        <div class="col-sm-6">
            <label class="radio-inline">
              {!! Form::radio('privacy', '0',true) !!}
              Public
            </label>
            <label class="radio-inline">
              {!! Form::radio('privacy', '1',false) !!}
              Visible to me
            </label>
            <label class="radio-inline">
              {!! Form::radio('privacy', '2',false) !!}
              Visible to contacts
            </label>
        </div>
  </div>

  <div class="form-group">
        {!! Form::label('null', "DIVISION", ['class' => 'col-xs-3 col-sm-2 control-label', 'style' => 'background-color:#ccc;text-align:center;padding-bottom:8px']) !!}
        <div class=" col-sm-6" style='padding-top:8px'>

            {!! Form::checkbox('division_1', 'health', ['class' => 'form-control']) !!}
            <span style="color:#0D8E56">Health & Epidemics</span></br>
            {!! Form::checkbox('division_2', 'science', ['class' => 'form-control']) !!}
            <span style="color:#1D73A3">Science & Environment</span><br>
            {!! Form::checkbox('division_3', 'response', ['class' => 'form-control']) !!}
            <span style="color:#DB9421">EM Practitioner & Response</span><br>
            {!! Form::checkbox('division_4', 'security', ['class' => 'form-control']) !!}
            <span style="color:#848889">Civil & Cyber Security</span><br>
            {!! Form::checkbox('division_5', 'continuity', ['class' => 'form-control']) !!}
            <span style="color:#933131">Business Continuity</span><br>
            {!! Form::checkbox('divisio_6', 'humanitarian', ['class' => 'form-control']) !!}
            <span style="color:#754293">NGO & Humanitarian</span><br>
        </div>
  </div>
  <div class="form-group">
        {!! Form::label('keywords', "tags", ['class' => 'col-xs-3 col-sm-2 control-label', 'style' => 'background-color:#ccc;text-align:center;padding-bottom:8px;text-transform:uppercase']) !!}
        <div class=" col-sm-6">
            {!! Form::input('keywords', 'keywords', null, ['class' => 'form-control', 'placeholder' => 'tsunami, tornado, ebola']) !!}
        </div>
  </div>
  <!-- <div class="form-group">
        {!! Form::label('description', "description", ['class' => 'col-xs-3 col-sm-2 control-label', 'style' => 'background-color:#ccc;text-align:center;padding-bottom:8px;text-transform:uppercase']) !!}
        <div class=" col-sm-6">
            {!! Form::input('description', 'description', null, ['class' => 'form-control', 'placeholder' => '250 words or less']) !!}
        </div>
  </div> -->
</div>
<div class="row">
<hr class="col-sm-10">
</div>
<div class="" style="padding-bottom:10px">
  <a class="btn btn-style" id="publication_form_toggle" href="#more_options" onclick="showMore()">ADDITIONAL FIELDS</a>
</div>

<div id="more_options">

  <div class="form-group">
        {!! Form::label('volume', "VOLUME", ['class' => 'col-xs-3 col-sm-2 control-label', 'style' => 'background-color:#ccc;text-align:center;padding-bottom:8px']) !!}
        <div class=" col-sm-6">
            {!! Form::input('volume', 'volume', null, ['class' => 'form-control']) !!}
        </div>
  </div>

  <div class="form-group">
        {!! Form::label('issue', "ISSUE", ['class' => 'col-xs-3 col-sm-2 control-label', 'style' => 'background-color:#ccc;text-align:center;padding-bottom:8px']) !!}
        <div class=" col-sm-6">
            {!! Form::input('issue', 'issues', null, ['class' => 'form-control']) !!}
        </div>
  </div>

  <div class="form-group">
        {!! Form::label('pages', "PAGES", ['class' => 'col-xs-3 col-sm-2 control-label', 'style' => 'background-color:#ccc;text-align:center;padding-bottom:8px']) !!}
        <div class=" col-sm-6">
            {!! Form::input('pages', 'pages', null, ['class' => 'form-control']) !!}
        </div>
  </div>

  <div class="form-group">
        {!! Form::label('publisher', "publisher", ['class' => 'col-xs-3 col-sm-2 control-label', 'style' => 'background-color:#ccc;text-align:center;padding-bottom:8px;text-transform:uppercase']) !!}
        <div class=" col-sm-6">
            {!! Form::input('publisher', 'publisher', null, ['class' => 'form-control']) !!}
        </div>
  </div>
  <div class="form-group">
        {!! Form::label('institution', "institution", ['class' => 'col-xs-3 col-sm-2 control-label', 'style' => 'background-color:#ccc;text-align:center;padding-bottom:8px;text-transform:uppercase']) !!}
        <div class=" col-sm-6">
            {!! Form::input('institution', 'institution', null, ['class' => 'form-control']) !!}
        </div>
  </div>
  <div class="form-group">
        {!! Form::label('conference', "conference", ['class' => 'col-xs-3 col-sm-2 control-label', 'style' => 'background-color:#ccc;text-align:center;padding-bottom:8px;text-transform:uppercase']) !!}
        <div class=" col-sm-6">
            {!! Form::input('conference', 'conference', null, ['class' => 'form-control']) !!}
        </div>
  </div>
</div>
<div class="form-group">
    <div class=" col-sm-6 col-sm-offset-1">
        {!! Form::submit('SAVE', ['class' => 'btn btn-style-alt']) !!}
    </div>
</div>

<br>
<script type="text/javascript">

            $(function () {

                $('#more_options').toggle();
            });
            $('#publication_date').click( function (){
              $('#datetimepicker1').datetimepicker({format: 'DD/MM/YYYY'});
            });
            function showMore () {
                $('#more_options').toggle();


            };
</script>
