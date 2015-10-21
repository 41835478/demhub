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
      <tr>
        <td><a href="{{$thread->route}}">{{$thread->title}}</a></td>
        <td>
        <a href="{{$thread->category->route}}">{{$thread->category->title}}</a>
        </td>
      <td>{{$thread->author->user_name}}</td>
      <td>{{(count($thread->posts)+1)}}</td>
      </tr>

      @endforeach
    </tbody>
</table>

@overwrite
