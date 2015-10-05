@extends('layouts.master')

@section('content')

<div id="discover-apps">
	<div class="row">
		<div class="col-md-12">
			{!! HTML::image('images/user/'.$user_avatar->image.'',
			        ''.Auth::user()->user_name.' icon',
			        array(
			          'class' => 'user-icon img-responsive img-thumbnail'
			        )
			) !!}

	    	<h1>{{Auth::user()->user_name}}'s Feed</h1>
	        <hr>
	    </div>
	    <div class="row text-center">
			<ul class="list-inline ">
			@foreach(app('followFeeds') as $feed)
				<li>
					<a href="#{{strip_tags($feed->getFeedCategory->category_name)}}" style="font-size:1.5em; color:#{{$feed->getFeedCategory->bg_color}};">
						{{str_replace('<br>',' ', $feed->getFeedCategory->category_name)}}
					</a>
				</li>
			@endforeach
			</ul>
		</div>
	    <div class="col-md-12 text-right">
			<h5>Arrange by</h5>
			<ul class="list-inline">
				<li>
					<a href="{{url('arrange-likes')}}">
						<i class="fa fa-thumbs-up" data-toggle="tooltip" data-placement="bottom" title="Likes"></i>
					</a>
				</li>
				<li>
					<a href="{{url('arrange-dislikes')}}">
						<i class="fa fa-thumbs-down" data-toggle="tooltip" data-placement="bottom" title="Dislikes"></i>
					</a>
				</li>
				<li>
					<a href="{{url('arrange-comments')}}">
						<i class="fa fa-commenting" data-toggle="tooltip" data-placement="bottom" title="Comments"></i>
					</a>
				</li>
			</ul>
		</div>
		    @foreach(app('followFeeds') as $feed)
		    	<div id="{{strip_tags($feed->getFeedCategory->category_name)}}">

		    		@foreach($feeds->chunk(5) as $fds)
		    			<div class="row">
			    			@foreach($fds as $data)
				    			@if($data->getFeed->category_id === $feed->getFeedCategory->id)

					    			<div class="col-md-3" id="feeds-main">
										<div class="col-md-12" id="feeds" style="border-top:10px solid #{{$feed->getFeedCategory->bg_color}};">
							    			<div id="ph-text">
												<h3><a href="{{$data->getFeed->link}}">{{$data->getFeed->title}}</a></h3>
												<span class="label label-default">{{date('F j, Y', $data->getFeed->pubDate)}}</span>
												<p>{{strip_tags($data->getFeed->desc, '<img>')}}</p>
												<!-- <?php

													$keys = $data->getFeed->keywords;
													$keywords = preg_split( "/[;,]/u", $keys);;
												?>
												@foreach($keywords as $keyword)
													@if($keyword != '')
														<span class="badge">{{$keyword}}</span>
													@endif
												@endforeach -->
											</div>
											<div id="social-actions">
												@include('user.menu-user.social-actions', array('feed' => $data->getFeed))
											</div>
										</div>
									</div>
				    			@endif
			    			@endforeach
		    			</div>
		    		@endforeach
	    		</div>

		    @endforeach


	</div>
</div>
@endsection('content')
