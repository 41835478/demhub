@extends('frontend.layouts.master')

@section('content')
	<div id="discover-apps" class="row">
		<div class="col-md-12">
			<h1>Discover<hr></h1>
		</div>
		<div class="row text-center">
    		{{$categories->appends(array('search' => Input::get('search')))->links()}}
    	</div>
    		@foreach($categories->chunk(4) as $categorys)
				<div class="row">
					@foreach($categorys as $category)
						<div class="col-md-3" id="feeds-main">
							<div class="col-md-12" id="feeds" style="border-top:10px solid #{{$category->getcategory->bg_color}};">
								<small style="color:#{{$category->getcategory->bg_color}};"><?php $foll = false;?>
									@if($category->getUserFeed)
										@foreach($category->getUserFeed as $follow)
											@if ($follow->user_id == Auth::user()->id && $follow->category_id == $category->category_id)
											
												<span class="badge" style="background:#{{$category->getcategory->bg_color}};">
													<a style="color:#FFF;" href="{{URL::route('follow-feed', array('id' => $category->getcategory->id))}}">
														<i class="fa fa-minus" data-toggle="tooltip" data-placement="top" title="Unfollow Feed"></i>
													</a>
												</span>
												<?php $foll = true; ?>
											@endif
										@endforeach
									@endif
									@if(!$foll)
										<span class="badge" style="background:#{{$category->getcategory->bg_color}};">
											<a style="color:#FFF;" href="{{URL::route('follow-feed', array('id' => $category->getcategory->id))}}">
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
									<?php 
										$keys = $category->keywords;
										$keywords = explode(';', $keys);
									?>
									@foreach($keywords as $keyword)
										@if($keyword != '')
											<span class="badge">{{$keyword}}</span>
										@endif
									@endforeach
								</div>
								<div id="social-actions">
									@include('user.menu-user.social-actions', array('feed' => $category))
								</div>
							</div>
						</div>
					@endforeach
				</div>
				
			@endforeach
		
		<div class="row text-center">
    		{{$categories->appends(array('search' => Input::get('search')))->links()}}
    	</div>
	</div>
	<script type="text/javascript">

		$(document).ready(function(){
			$("i").hover(
				function(){
					$(this).tooltip('show');
				}, function() {
					$(this).tooltip('hide');
				}
			);

		});
	</script>
@endsection('content')