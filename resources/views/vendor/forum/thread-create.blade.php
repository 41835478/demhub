@extends ('frontend.layouts.master')
@section('forum::layouts.master')

@section('content')
<div class="row" style="padding-top:15px">
	<div class="col-md-8 col-md-offset-2">
<!-- @include('forum::partials.breadcrumbs', compact('parentCategory', 'category', 'thread')) -->
<a href="{{ url('forum/all_threads') }}" class="btn btn-default btn-style-alt">ALL THREADS</a>
<h2>NEW DISCUSSION</h2>

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
</div>
</div>
<script>
$("button#submit").attr("disabled", true);

$("select#division_selection").change(function(){

    $("button#submit").attr("disabled", false);

});
</script>
@overwrite
