@extends('frontend.layouts.master')

@section('content')
    <div class="container-fluid row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8">
            @include('frontend.search._result_snippet', [
                'results'=>$userResults,        'scope'=>'users',           'label'=>'Users',           'totalCount'=>$userTotalCount
            ])
            @include('frontend.search._result_snippet', [
                'results'=>$publicationResults, 'scope'=>'publications',    'label'=>'Publications',    'totalCount'=>$publicationTotalCount
            ])
            @include('frontend.search._result_snippet', [
                'results'=>$resourceResults,    'scope'=>'resources',       'label'=>'Resources',       'totalCount'=>$resourceTotalCount
            ])
            @include('frontend.search._result_snippet', [
                'results'=>$articleResults,     'scope'=>'articles',        'label'=>'Articles',        'totalCount'=>$articleTotalCount
            ])
            @include('frontend.search._result_snippet', [
                'results'=>$discussionResults,  'scope'=>'discussions',     'label'=>'Discussions',     'totalCount'=>$discussionTotalCount
            ])
        </div>
    </div>
@stop
