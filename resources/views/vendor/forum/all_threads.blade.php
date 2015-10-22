@extends ('frontend.layouts.master')
@include ('forum::layouts.master')

@section('content')
<!-- @include('forum::partials.breadcrumbs') -->

<h2>{{ trans('forum::base.index') }}</h2>

<div class="row">
	<div class="col-xs-4">

		<a href="{{ $categories[6]->newThreadRoute }}" class="btn btn-primary">{{ trans('forum::base.new_thread') }}</a>

	</div>

</div>

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
        <!-- <a href="{{$thread->category->route}}"> -->
					{{$thread->category->title}}
				<!-- </a> -->
        </td>
      <td>{{$thread->author->user_name}}</td>
      <td>{{(count($thread->posts)+1)}}</td>
      </tr>

      @endforeach
    </tbody>
</table>

@overwrite
