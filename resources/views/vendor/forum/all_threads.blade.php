@extends('frontend.layouts.master')

@section('content')
@include('forum::partials.breadcrumbs')

<h2>{{ trans('forum::base.index') }}</h2>



<table class="table table-index">
    <thead>
        <tr>
            <th>{{ trans('forum::base.threads') }}</th>
			<th>{{ trans('forum::base.category') }}</th>
            
			<th>Author</th>
			<th>{{ trans('forum::base.posts') }}</th>
        </tr>
    </thead>
    <tbody>
		@foreach ($threads as $thread)
       
        @if (!$category->subcategories->isEmpty())
        <tr>
            <td>{{ trans('forum::base.subcategories') }}</td>
            <th>{{ trans('forum::base.threads') }}</th>
            <th>{{ trans('forum::base.posts') }}</th>
        </tr>
        @foreach ($category->subcategories as $subcategory)
        <tr>
            <td>
                <a href="{{ $subcategory->route }}">{{ $subcategory->title }}</a>
                <br>
                {{ $subcategory->subtitle }}
                @if ($subcategory->newestThread)
				<div class="text-muted">
                    <br>
                    {{ trans('forum::base.newest_thread') }}:
                    <a href="{{ $subcategory->newestThread->route }}">
                        {{ $subcategory->newestThread->title }}
                        ({{ $subcategory->newestThread->authorName }})</a>
                    <br>
                    {{ trans('forum::base.last_post') }}:
                    <a href="{{ $subcategory->latestActiveThread->lastPost->route }}">
                        {{ $subcategory->latestActiveThread->title }}
                        ({{ $subcategory->latestActiveThread->lastPost->authorName }})</a>
				</div>
                @endif
            </td>
            <td>{{ $subcategory->threadCount }}</td>
            <td>{{ $subcategory->postCount }}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <th colspan="3">
                {{ trans('forum::base.no_categories') }}
            </th>
        </tr>
        @endif
    </tbody>
</table>
@endforeach
@overwrite
