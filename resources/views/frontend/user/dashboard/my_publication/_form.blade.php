
<div id="main_publication_form">

  <div class="form-group">
    {!! Form::label('title', "Title", ['class' => 'col-xs-3 col-sm-2 control-label my-publication-label']) !!}
    <div class = "col-xs col-sm-6">
      {!! Form::input('text', 'name', null, ['class' => 'form-control']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('document', "Document", ['class' => 'col-xs-3 col-sm-2 control-label my-publication-label']) !!}
    <div class="col-sm-6" style='{{isset($publication) && $publication->mainMedia() ? "" : "padding-top:8px"}}'>
      @if (isset($publication) && $publication->mainMedia())
        <input type="text" class="form-control" value="{{$publication->mainMediaName()}}" disabled/>
      @else
        {!! Form::file('document', null, ['class' => 'form-control', 'required']) !!}
      @endif
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('description', "Description", ['class' => 'col-xs-3 col-sm-2 control-label my-publication-label']) !!}
    <div class="col-sm-6">
      {!! Form::input('text', 'description', null,
      ['class' => 'form-control ', 'maxlength'=>'255', 'placeholder' => '50 words or less', 'id' => 'description']) !!}
    </div>
    <div class="help-block with-errors"></div>
  </div>

  <div class="form-group">
    {!! Form::label('author', "Author", ['class' => 'col-xs-3 col-sm-2 control-label my-publication-label']) !!}
    <div class="col-sm-6">
      <?php $name = isset($publication) ? $publication->author() : Auth::user()->full_name() ?>
      {!! Form::input('text', 'publication_author', $name, ['class' => 'form-control ', 'maxlength'=>'255']) !!}
    </div>
    <div class="help-block with-errors"></div>
  </div>

  <div class="form-group">
    {!! Form::label('publication_date', "Date", ['class' => 'col-xs-3 col-sm-2 control-label my-publication-label']) !!}
    <div class="col-sm-6 input-group date" id='datetimepicker1' style="padding-left:10px;padding-right:10px">
      <span class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
      </span>
      @if (isset($publication->publish_date))
        <input type="text" name="publication_date" id="publication_date" class="form-control" value="{{date_format(new DateTime($publication->publication_date), 'd/m/Y')}}" required/>
      @else
        {!! Form::input('publication_date', 'publication_date', null, ['class' => 'form-control','required', 'id' => 'publication_date']) !!}
      @endif
    </div>
    <div class="help-block with-errors"></div>
  </div>

  <div class="form-group">
    {!! Form::label('visibility', "Visibility", ['class' => 'col-xs-3 col-sm-2 control-label my-publication-label']) !!}
    <div class="col-sm-6">
      <label class="radio-inline">
        {!! Form::radio('visibility', '1', true) !!}
        Public
      </label>
      <label class="radio-inline">
        {!! Form::radio('visibility', '0', false) !!}
        Visible only to me
      </label>
      <label class="radio-inline">
        {!! Form::radio('visibility', '2', false) !!}
        Visible only to contacts
      </label>
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('null', "Division", ['class' => 'col-xs-3 col-sm-2 control-label my-publication-label']) !!}
    <div class="col-sm-6" style='padding-top:8px'>

      @foreach($divisions as $div)
        @if($publication->divisions() !== NULL && array_key_exists($div->slug, $publication->divisions()))
          {!! Form::checkbox("division_{$div->id}", $div->id, true, ['class' => '']) !!}
        @else
          {!! Form::checkbox("division_{$div->id}", $div->id, false, ['class' => '']) !!}
        @endif
        <span class="{{ $div->slug }}-font-color" style="text-transform:capitalize">{{$div->name}}</span><br>
      @endforeach

    </div>
  </div>
  <div class="form-group">
    {!! Form::label('keywords', "Tags", ['class' => 'col-xs-3 col-sm-2 control-label my-publication-label']) !!}
    <div class=" col-sm-6">
      {!! Form::input('keywords', 'keywords', null, ['class' => 'form-control', 'placeholder' => 'tsunami, tornado, ebola']) !!}
    </div>
  </div>

</div>

<div class="row">
  <hr class="col-sm-10">
</div>

<div class="" style="padding-bottom:10px">
  <a class="btn btn-style" id="publication_form_toggle" href="#more_options" onclick="showMore()">ADDITIONAL FIELDS</a>
</div>

<div id="more_options">

  <div class="form-group">
    {!! Form::label('volume', "VOLUME", ['class' => 'col-xs-3 col-sm-2 control-label my-publication-label']) !!}
    <div class=" col-sm-6">
      {!! Form::input('volume', 'volume', $publication->volume() ?: null , ['class' => 'form-control', "pattern" => "^[_0-9]{1,}$"]) !!}
    </div>

    <span class="help-block">Must be numbers only</span>
  </div>

  <div class="form-group">
    {!! Form::label('issue', "ISSUE", ['class' => 'col-xs-3 col-sm-2 control-label my-publication-label']) !!}
    <div class=" col-sm-6">
        {!! Form::input('issue', 'issues', $publication->issues() ?: null, ['class' => 'form-control']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('pages', "PAGES", ['class' => 'col-xs-3 col-sm-2 control-label my-publication-label']) !!}
    <div class=" col-sm-6">
        {!! Form::input('pages', 'pages', $publication->pages() ?: null, ['class' => 'form-control', "pattern" => "^[_0-9]{1,}$"]) !!}
    </div>
    <span class="help-block">Must be numbers only</span>
  </div>

  <div class="form-group">
        {!! Form::label('publisher', "publisher", ['class' => 'col-xs-3 col-sm-2 control-label my-publication-label']) !!}
        <div class=" col-sm-6">
            {!! Form::input('publisher', 'publisher', $publication->publisher() ?: null, ['class' => 'form-control']) !!}
        </div>
  </div>
  <div class="form-group">
        {!! Form::label('institution', "institution", ['class' => 'col-xs-3 col-sm-2 control-label my-publication-label']) !!}
        <div class=" col-sm-6">
            {!! Form::input('institution', 'institution', $publication->institution() ?: null, ['class' => 'form-control']) !!}
        </div>
  </div>
  <div class="form-group">
        {!! Form::label('conference', "conference", ['class' => 'col-xs-3 col-sm-2 control-label my-publication-label',]) !!}
        <div class=" col-sm-6">
            {!! Form::input('conference', 'conference', $publication->conference() ?: null, ['class' => 'form-control']) !!}
        </div>
  </div>

</div>

<div class="form-group">
  <div class=" col-sm-6 col-sm-offset-1">
    {!! Form::submit('SAVE', ['class' => 'btn btn-style-alt']) !!}
  </div>
</div>

<br>

<style media="screen">
  .my-publication-label {
    background-color: #ccc;
    text-align: center;
    padding-bottom: 8px;
    text-transform: uppercase
  }
  .health-font-color {
    color:#0D8E56;
  }
  .science-font-color {
    color:#1D73A3;
  }
  .response-font-color {
    color:#DB9421;
  }
  .security-font-color {
    color:#848889;
  }
  .continuity-font-color {
    color:#933131;
  }
  .humanitarian-font-color {
    color:#754293;
  }
</style>

{{-- TODO: Move this to the js folder --}}
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
