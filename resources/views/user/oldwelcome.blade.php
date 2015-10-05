	    @foreach ($feeds as $feed)
		    <?php 
		    	$col;
		    	if (12 % $feeds->count() ==  0){
		    		$col = 12/$feeds->count();
		    	}
		    	else {
		    		$col = 12%$feeds->count();
		    	} 
		    ?>
		    <style>
				div.paginated_{{$feed->getFeedCategory->id}} ul.pagination li span{
					color: #{{$feed->getFeedCategory->bg_color}};
				}
				div.paginated_{{$feed->getFeedCategory->id}}  ul.pagination li.active span {
					background: #{{$feed->getFeedCategory->bg_color}};
					border: 1px solid #{{$feed->getFeedCategory->bg_color}};
					color:#FFF;
				}
				div.paginated_{{$feed->getFeedCategory->id}}  ul.pagination li a {
					color: #{{$feed->getFeedCategory->bg_color}};
				}
				div#ph-text__{{$feed->getFeedCategory->id}} h3 a {
					color: #{{$feed->getFeedCategory->bg_color}};
				}
			</style>
	    	<div class="col-md-{{$col}}">
	    		<h3 class="text-center" style="color:#{{$feed->getFeedCategory->bg_color}};">{{$feed->getFeedCategory->category_name}}</h3>
	    		<div class="col-md-12 text-center paginated_{{$feed->getFeedCategory->id}}">
	    			{{$feed->getFeedCategory->xmlfeeddata()->paginate(5)->links()}}
	    		</div>
	    		<div class="col-md-12">
					@foreach ($feed->getFeedCategory->xmlfeeddata()->paginate(5) as $data)
						<div class="col-md-2">
			    			<h5 style="color:#{{$data->getcategory->bg_color}};">{{$data->getcategory->category_name}}</h5>
			    		</div>
			    		<div id="ph-text__{{$feed->getFeedCategory->id}}" class="col-md-10 lead">
							<h3><a href="{{$data->link}}" target="_blank">{{$data->title}}</a></h3>
							<p>{{strip_tags($data->desc, '<img>')}}</p>
							@if(!empty($data->keywords))
								<span class="badge">{{$data->keywords}}</span>
							@endif
							<span class="label label-default">{{date('F j, Y', $data->pubDate)}}</span>
						</div>
						<div class="col-md-12">
							@include('user.menu-user.social-actions', array('feed' => $data))
						</div>
					@endforeach
				</div>

			</div>
		@endforeach