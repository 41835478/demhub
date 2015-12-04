{!! Form::open(['url' => $form_url, 'class' => $form_classes,'data-toggle'=>'validator', 'data-delay'=>'1100']) !!}

@if ( $show_title_field )
<div class="form-group">
    <label for="title">{{ trans('forum::base.title') }}</label>
    {!! Form::text('title', Input::old('title'), ['class' => 'form-control','required']) !!}
    <div class="help-block with-errors"></div>
</div>
@endif

@if ($division_show == true)
<div class="form-group">
  {!! Form::select('division_selection', array('0' => 'Select One','7' => 'General','1' => 'Health', '2' => 'Science & Environment', '3' => 'EM Practitioner & Response', '4' => 'Civil & Cyber Security', '5' => 'Business Continuity', '6' => 'NGO & Humanitarian'), '0', array('class' => 'form-control', 'id' => 'division_selection','required')) !!}
  <div class="help-block with-errors"></div>
</div>
@else

@endif

<div class="form-group">
    {!! Form::textarea('content', $post_content, ['class' => 'form-control','data-minlength'=>'6']) !!}
    <div class="help-block with-errors"></div>
</div>

<button type="submit" id="submit" class="btn btn-style-alt">{{ $submit_label }}</button>
@if ( $cancel_url )
<a href="{{ $cancel_url }}" class="btn btn-default btn-style-alt">{{ trans('forum::base.cancel') }}</a>
@endif

{!! Form::close() !!}
