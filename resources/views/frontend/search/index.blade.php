@extends('frontend.layouts.master')

@section('content')

<div class="container-fluid row">
    <div class="col-xs-12 col-sm-offset-2 col-sm-8">
        @include('frontend.search._result_snippet', ['results'=>$userResults, 'scope'=>'users', 'label'=>'Users', 'totalCount'=>$userTotalCount])
        @include('frontend.search._result_snippet', ['results'=>$publicationResults, 'scope'=>'publications', 'label'=>'Publications', 'totalCount'=>$publicationTotalCount])
        @include('frontend.search._result_snippet', ['results'=>$resourceResults, 'scope'=>'resources', 'label'=>'Resources', 'totalCount'=>$resourceTotalCount])
        @include('frontend.search._result_snippet', ['results'=>$articleResults, 'scope'=>'articles', 'label'=>'Articles', 'totalCount'=>$articleTotalCount])
    </div>

</div>

{{--
  @if(true)

    <div class="container">
      <div class="row">
        <h2 class="text-center">
          @if(empty($queryTerm))
            All Results
          @else
            Results for "{{ $queryTerm }}"
          @endif
        </h2>
        <hr>
      </div>
    </div>

    <div class="row row-horizon search-row">

      @if($articleTotalCount > 0)
        <div class="col-sm-6">
          @include('frontend.search._results', [
            'model' => 'article',
            'title' => 'News',
            'url' => "/divisions" . (empty($queryTerm) ? '' : '?query_term='.$queryTerm),
            'total' => $articleTotalCount
          ])
        </div>
      @endif

      @if($userTotalCount > 0)
        <div class="col-sm-6">
          @include('frontend.search._results', [
            'model' => 'user',
            'title' => 'Members',
            'url' => "/profiles",
            'total' => NULL
          ])
        </div>
      @endif

      {{-- <div class="col-sm-6">
        @include('frontend.search._results', [
          'model' => 'discussion',
          'title' => 'Discussions',
          'url' => "/forum/all_threads",
          'total' => $discussionTotalCount
        ])
      </div>

      @if($publicationTotalCount > 0)
        <div class="col-sm-6">
          @include('frontend.search._results', [
            'model' => 'publication',
            'title' => 'Publications',
            'url' => "/public_journal",
            'total' => $publicationTotalCount
          ])
        </div>
      @endif

      @if($resourceTotalCount > 0)
        <div class="col-sm-6">
          @include('frontend.search._results', [
            'model' => 'resource',
            'title' => 'Resources',
            'url' => "/resources",
            'total' => $resourceTotalCount
          ])
        </div>
      @endif

    </div>
  @endif
--}}
@stop
