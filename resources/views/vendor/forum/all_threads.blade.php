@extends ('frontend.layouts.master')

@extends ('forum::layouts.master')

@section('content')
<div class="row">
	<!-- @include('forum::partials.breadcrumbs') -->

	<!-- <h2>{{ trans('forum::base.index') }}</h2> -->

	<div class="row container-fluid" style="padding-top:15px">
		<div class="col-md-6 col-md-offset-3">

			<a href="7-category/thread/create" class="btn btn-style-alt col-sm-offset-9">NEW DISCUSSION</a>
		</div>
		<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
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
                      @if(! empty($divisions))
                            @foreach ($divisions as $divSlug => $divName)
			                        <span>
		  							        <img src="/images/backgrounds/patterns/alpha_layer.png" alt="" class="img-circle img-responsive division_{{$divSlug}}" style="height:22px">
		  						    </span>

                            @endforeach
                        @else
                                <img src="/images/backgrounds/patterns/alpha_layer.png" alt="" class="img-circle img-responsive division_all" style="height:22px">
                        @endif
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
