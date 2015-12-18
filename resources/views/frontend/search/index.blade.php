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
      </div> --}}

      @if($publicationTotalCount > 0)
        <div class="col-sm-6">
          @include('frontend.search._results', [
            'model' => 'publication',
            'title' => 'Publications',
            'url' => "/pub_article",
            'total' => $publicationTotalCount
          ])
        </div>
      @endif

      @if($userTotalCount > 0)
        <div class="col-sm-6">
          @include('frontend.search._results', [
            'model' => 'resource',
            'title' => 'Resources',
            'url' => "/resource_filter",
            'total' => $userTotalCount
          ])
        </div>
      @endif

    </div>
  @endif

@stop
