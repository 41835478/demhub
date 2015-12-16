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
      <div class="col-sm-6">
        @include('frontend.search._results', [
          'model' => 'article',
          'title' => 'News',
          'url' => "/divisions" . (empty($queryTerm) ? '' : '?query_term='.$queryTerm),
          'total' => $articleTotalCount
        ])
      </div>
      <div class="col-sm-6">
        @include('frontend.search._results', [
          'model' => 'user',
          'title' => 'Members',
          'url' => "/profiles",
          'total' => $userTotalCount
        ])
      </div>
      {{-- <div class="col-sm-6">
        @include('frontend.search._results', [
          'model' => 'discussion',
          'title' => 'Discussions',
          'url' => "/forum/all_threads",
          'total' => $discussionTotalCount
        ])
      </div> --}}
      <div class="col-sm-6">
        @include('frontend.search._results', [
          'model' => 'publication',
          'title' => 'Publications',
          'url' => "/publication_filter",
          'total' => $publicationTotalCount
        ])
      </div>
      <div class="col-sm-6">
        @include('frontend.search._results', [
          'model' => 'resource',
          'title' => 'Resources',
          'url' => "/resource_filter",
          'total' => $resourceTotalCount
        ])
      </div>
    </div>
  @endif

  <style media="screen">
    thead {
      width: calc( 100% - 1em );
    }
    tbody {
      display:block;
      height: calc( 100vh - 280px);
      overflow:auto;
    }
    thead, tbody tr {
      display:table;
      width:100%;
      table-layout:fixed;
    }
  </style>

@stop
