@extends('frontend.layouts.master')

@section('content')
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
            // NOTE - Business decision NOT to show total users
            'total' => NULL
          ])
        </div>
      @endif

      @if($discussionTotalCount > 0)
        <div class="col-sm-6">
          @include('frontend.search._results', [
            'model' => 'discussion',
            'title' => 'Discussions',
            'url' => "/forum/all_threads",
            'total' => $discussionTotalCount
          ])
        </div>
      @endif

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

@stop
