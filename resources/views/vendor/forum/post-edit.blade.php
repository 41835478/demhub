@extends ('frontend.layouts.master')
@section('forum::layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
    {{-- @include('forum::partials.breadcrumbs', compact('parentCategory', 'category', 'thread')) --}}

    <h2>{{ trans('forum::base.edit_post') }} from "{{$thread->name}}"</h2>

    @include(
        'forum::partials.forms.post',
        array(
            'form_url'          => $post->editRoute,
            'form_classes'      => '',
            'show_title_field'  => false,
            'division_show'     => false,
            'post_content'      => $post->content,
            'submit_label'      => trans('forum::base.edit_post'),
            'cancel_url'        => $post->thread->route
        )
    )
    </div>
</div>
@overwrite
