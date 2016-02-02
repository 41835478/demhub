@extends('frontend.layouts.master')

@section('content')

<div class="container-fluid row">
    <div class="col-xs-12 col-sm-offset-2 col-sm-8">
        @include('frontend.search.__result-snippet', ['results'=>$userResults, 'scope'=>'users', 'label'=>'Users']);
        @include('frontend.search.__result-snippet', ['results'=>$publicationResults, 'scope'=>'publications', 'label'=>'Publications']);
        @include('frontend.search.__result-snippet', ['results'=>$resourceResults, 'scope'=>'resources', 'label'=>'Resources']);
        @include('frontend.search.__result-snippet', ['results'=>$articleResults, 'scope'=>'articles', 'label'=>'Articles']);
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
