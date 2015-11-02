@extends ('frontend.layouts.master')

@extends ('forum::layouts.master')

@section('content')
<div class="row" style="padding:0px;
                                background:url('/images/backgrounds/earth_17.jpg')  no-repeat fixed;
                                background-position: 100% 70%;
                                overflow:hidden;">
<!-- @include('forum::partials.breadcrumbs') -->

<!-- <h2>{{ trans('forum::base.index') }}</h2> -->


<div class="row" style="padding-top:15px">
	<div class="col-md-8 col-md-offset-2">
<table class="table table-index table-hover">

    <thead>
        <tr>
            <th><a href="{{ $categories[6]->newThreadRoute }}" class="btn btn-default btn-style">NEW THREAD</a></th>
			<th>DIVISION</th>

			<th>AUTHOR</th>
			<th>POSTS</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($threads as $thread)
      <tr>
        <td><a href="{{$thread->route}}" ><b>{{$thread->title}}</b></a></td>
        <td>
        <a href="{{url('/division/'.$thread->category->slug)}}">
					<img src="/images/backgrounds/nothing.png" alt="" class="img-circle img-responsive" style="background-color:#{{$thread->category->bg_color}};height:22px">
				</a>
        </td>
      <td><img class="img-responsive img-circle" style="width:25px;display:inline;" src="{{$thread->author->avatar->url('thumb')}}"><span style="visibility:hidden">*</span> {{$thread->author->user_name}}</td>
      <td><p style="padding-top:4px"><span class="label label-default" >{{(count($thread->posts))}}</span></p></td>
      </tr>

      @endforeach
    </tbody>
</table>
</div>
</div>
{!! $threads->render() !!}
</div>

@overwrite
