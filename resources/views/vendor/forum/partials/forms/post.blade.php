
<?php if(! empty($contentId)){
    $form_url=Request::url();
    } ?>
{!! Form::open(['url' => $form_url, 'class' => $form_classes,'data-toggle'=>'validator', 'data-delay'=>'1100']) !!}

@if ( $show_title_field )
<div class="form-group">
    <label for="title">{{ trans('forum::base.title') }}</label>
    {!! Form::text('title', isset($title) ? $title : old('title'), ['class' => 'form-control','required']) !!}
    <div class="help-block with-errors"></div>
</div>
@endif

@if ($division_show == true)
<div class="form-group">
  {!! Form::select('division_selection', array('' => 'Select One','' => 'General','1' => 'Health', '2' => 'Science & Environment', '3' => 'EM Practitioner & Response', '4' => 'Civil & Cyber Security', '5' => 'Business Continuity', '6' => 'NGO & Humanitarian'), '', array('class' => 'form-control', 'id' => 'division_selection','required')) !!}
  <div class="help-block with-errors"></div>
</div>
@else

@endif

<div class="form-group">
    {!! Form::textarea('content', isset($content) ? $content : old('content'), ['class' => 'form-control','data-minlength'=>'6','style' => 'resize: vertical;']) !!}
    <div class="help-block with-errors"></div>
</div>

<button type="submit" id="submit" class="btn btn-style-alt" style="text-transform:uppercase">{{ $submit_label }}</button>
@if ( $cancel_url )
<a href="{{ $cancel_url }}" class="btn btn-default btn-style-alt" style="text-transform:uppercase">{{ trans('forum::base.cancel') }}</a>
@endif

{!! Form::close() !!}
