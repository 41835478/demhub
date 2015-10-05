
@extends('layouts.master')

@section('content')
<?php

?>
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
			@foreach($feeds as $feed)
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


		@foreach($feeds as $feed)

		<div id="{{strip_tags($feed->getFeedCategory->category_name)}}">
			 <style>
				div#paginated_{{$feed->getFeedCategory->id}} ul.pagination li span{
					color: #{{$feed->getFeedCategory->bg_color}};
				}
				div#paginated_{{$feed->getFeedCategory->id}}  ul.pagination li.active span {
					background: #{{$feed->getFeedCategory->bg_color}};
					border: 1px solid #{{$feed->getFeedCategory->bg_color}};
					color:#FFF;
				}
				div#paginated_{{$feed->getFeedCategory->id}}  ul.pagination li a {
					color: #{{$feed->getFeedCategory->bg_color}};
				}
			</style>
			<!-- <div id="paginated_{{$feed->getFeedCategory->id}}" class="row text-center">
				{{$feed->getFeed()->paginate(15)->links()}}
			</div> -->
			@foreach($feed->getFeed()->paginate(16)->chunk(4) as $fds)
				<div class="row">
					@foreach($fds as $category)
						<div class="col-md-6 col-md-offset-3" id="feeds-main">
							<div class="col-md-12" id="feeds" style="border-top:10px solid #{{$category->getcategory->bg_color}};">
								<small style="color:#{{$category->getcategory->bg_color}};"><?php $foll = false;?>
									@if($category->getUserFeed)
										@foreach($category->getUserFeed as $follow)
											@if ($follow->user_id == Auth::user()->id && $follow->category_id == $category->category_id)
												<span class="badge" style="background:#{{$category->getcategory->bg_color}};">
													<a style="color:#FFF;" href="{{url('follow-feed', array('id' => $category->getcategory->id))}}">
														<i class="fa fa-minus" data-toggle="tooltip" data-placement="top" title="Unfollow Feed"></i>
													</a>
												</span>
												<?php $foll = true; ?>
											@endif
										@endforeach
									@endif
									@if(!$foll)
										<span class="badge" style="background:#{{$category->getcategory->bg_color}};">
											<a style="color:#FFF;" href="{{url('follow-feed', array('id' => $category->getcategory->id))}}">
												<i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Follow Feed"></i>
											</a>
										</span>
									@endif
									{{str_replace('<br>', ' ', $category->getcategory->category_name)}}
								</small>
								<div id="ph-text">
									<h3><a href="{{$category->link}}">{{$category->title}}</a></h3>
									<span class="label label-default">{{date('F j, Y', $category->pubDate)}}</span>
									<p>{{strip_tags($category->desc, '<img>')}}</p>
									<!-- <?php

										$keys = $category->keywords;
										$keywords = preg_split( "/[;,]/u", $keys);;
									?>
									@foreach($keywords as $keyword)
										@if($keyword != '')
											<span class="badge">{{$keyword}}</span>
										@endif
									@endforeach -->
								</div>
								<div id="social-actions">
									@include('user.menu-user.social-actions', array('feed' => $category))
								</div>
							</div>
						</div>
					@endforeach
				</div>

			@endforeach
				<div id="paginated_{{$feed->getFeedCategory->id}}" class="row text-center">
					{{$feed->getFeed()->paginate(15)->links()}}
				</div>
			<hr>
		</div>
		@endforeach


	</div>
</div>

@endsection('content')
