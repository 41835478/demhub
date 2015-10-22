@extends ('frontend.layouts.master')
@section('forum::layouts.master')

@section('content')
<!-- @include('forum::partials.breadcrumbs', compact('parentCategory', 'category', 'thread')) -->

<h2>{{ trans('forum::base.new_thread') }}</h2>

@include(
    'forum::partials.forms.post',
    array(
        'form_url'            => $category->newThreadRoute,
        'form_classes'        => '',
        'show_title_field'    => true,
        'division_show'       => true,
        'post_content'        => '',
        'submit_label'        => trans('forum::base.send'),
        'cancel_url'          => ''
    )
)
<script>
$("button#submit").attr("disabled", true);

$("select#division_selection").change(function(){

    $("button#submit").attr("disabled", false);

});
</script>
@overwrite
