@extends ('frontend.layouts.master')

@extends ('forum::layouts.master')

@section('content')
<div class="row">
	<!-- @include('forum::partials.breadcrumbs') -->

	<!-- <h2>{{ trans('forum::base.index') }}</h2> -->

	<div class="row container-fluid" style="padding-top:15px">
		<div class="col-md-8 col-md-offset-2">

			<a href="{{ $categories[6]->newThreadRoute }}" class="btn btn-style-alt col-xs-offset-8">NEW DISCUSSION</a>
		</div>
		<div class="col-md-9 col-md-offset-2">
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
					<?php
					$divisions=Helpers::divHash($thread['divisions']);
					 ?>

						<tr>

							{{-- <td><a href="{{$thread->route}}" class="text-link-style"><b>{{$thread['name']}}</b></a></td> --}}

							<td><a href="{{Helpers::route($thread)}}" class="text-link-style"><b>{{$thread['name']}}</b></a></td>
  			      <td>
								@foreach ($divisions as $divSlug => $divName)
			            <a href="{{url('/division/'.$divSlug)}}">
		  							<img src="/images/backgrounds/patterns/alpha_layer.png" alt="" class="img-circle img-responsive division_{{$divSlug}}" style="height:22px">
		  						</a>
			          @endforeach
  			      </td>
							<?php  $uploader=$author=Helpers::uploader($thread); ?>

  			    	<td><img class="img-responsive img-circle" style="width:25px;display:inline;" src="{{$author->avatar->url('thumb')}}"><span style="visibility:hidden">*</span> {{$author->first_name}} {{$author->last_name}}</td>
							<td><p style="padding-top:4px"><span class="label label-default" >{{count(Helpers::posts($thread))}}</span></p></td>
							{{-- <td><p style="padding-top:4px"><span class="label label-default" >{{(count($thread->posts))}}</span></p></td> --}}
  			    </tr>
			    @endforeach
			  </tbody>
			</table>

		</div>
	</div>

</div>

@overwrite
