@extends ('frontend.layouts.master')

@extends ('forum::layouts.master')

@section('content')
<div class="row">
	<!-- @include('forum::partials.breadcrumbs') -->

	<!-- <h2>{{ trans('forum::base.index') }}</h2> -->

	<div class="row container-fluid" style="padding-top:15px">
		<div class="col-md-8 col-md-offset-2">

			<a href="{{ $categories[6]->newThreadRoute }}" class="btn btn-style-alt col-xs-offset-8">NEW DISCUSSION</a>
			<table class="table table-index table-hover">
			  <thead>
			    <tr>
			      <th></th>
						<th>DIVISION</th>

						<th>AUTHOR</th>
						<th>POSTS</th>
			    </tr>
			  </thead>

			  <tbody>
			    @foreach ($threads as $thread)


			    <tr>
			      <td><a href="{{$thread->route}}" class="text-link-style"><b>{{$thread->title}}</b></a></td>
			      <td>
			      <a href="">
							<img src="/images/backgrounds/patterns/alpha_layer.png" alt="" class="img-circle img-responsive division_{{$thread->category->id}}" style="height:22px">
						</a>
			      </td>
			    <td><img class="img-responsive img-rounded" style="width:25px;display:inline;" src="{{$thread->author->avatar->url('thumb')}}"><span style="visibility:hidden">*</span> {{$thread->author->first_name}} {{$thread->author->last_name}}</td>
			    <td><p style="padding-top:4px"><span class="label label-default" >{{(count($thread->posts))}}</span></p></td>
			    </tr>

			    @endforeach
			  </tbody>
			</table>
		</div>
	</div>
	 {{-- {!! $threads->render() !!}  --}}
</div>

@overwrite
