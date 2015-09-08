@extends('structure.main')

@section('content')
<script>
$(document).ready(function(){
	$("div#ph-text > p").find('br').remove();
	$("div#ph-text > p").find('a').remove();

});
</script>

@foreach($category as $cat)
	<div id="welcome-division">
		
		<div id="welcome-division-category" class="row" style="background:
																url('../images/backgrounds/{{$cat->bg_image}}') no-repeat fixed 0% 70%; 
																-webkit-background-size: cover;
																-moz-background-size: cover;
																-o-background-size: cover;
																background-size: cover;
																overflow: hidden;"
		>
		<div class="row" style="padding-top:50px">
		<div id="welcome-division-menu" class="col-xs-12" style="opacity: 0.75;filter: alpha(opacity=75)">
			@include('guest.menu-user.categories')
		</div>
		</div>
			<div class="row">
			<div id="ph-name" class="col-md-4 col-md-offset-8 text-center" style="opacity: 0.75;filter: alpha(opacity=75)">
				<h1 style="background:#{{$cat->bg_color}};">{{$cat->category_name}}</h1>
			</div>
			</div>
			
		
		
		</div>
		
		<style>
			div.paginated ul.pagination li span{
				color: #{{$cat->bg_color}};
			}
			div.paginated ul.pagination li.active span {
				background: #{{$cat->bg_color}};
				border: 1px solid #{{$cat->bg_color}};
				color:#FFF;
			}
			div.paginated ul.pagination li a {
				color: #{{$cat->bg_color}};
			}
		
		</style>
		<div class="col-md-9 col-md-offset-1 text-left">
			<h2 style="color:#{{$cat->bg_color}};">DISCUSSION</h2>
			<hr style="border-color:#{{$cat->bg_color}};">
		</div>
		<div class="col-md-9 col-md-offset-1">
			<div class="col-md-12 paginated" >
				{{$discussions->appends(array('item' => 'discussion'))->links()}}
			</div>
			<div id="ph-text" class="col-md-12 text-left">
				@foreach($discussions as $data)
					<h3>{{$data->discussion_title}}</h3>
					<span class="label label-default"><small>Last updated: </small>{{date('F j, Y', strtotime($data->updated_at))}}</span>

					<p>{{$data->discussion_paragraph}}</p>
					<hr>
				@endforeach
			</div>
		</div>
		<div class="col-md-9 col-md-offset-1 text-left">
			<h2 style="color:#{{$cat->bg_color}};">NEWS</h2>
			<hr style="border-color:#{{$cat->bg_color}};">
		</div>

		<div class="col-md-9 col-md-offset-1" style="overflow-x:hidden">
			<!-- <div class="col-md-12 paginated" >
				{{$cat->xmlfeeddata()->paginate(15)->appends(array('item' => 'news'))->links()}}
			</div> -->
			<div id="ph-text" class="text-left">
				@foreach($cat->xmlfeeddata()->paginate(15) as $data)
					<div class="col-md-12">
						<h3><a href="{{$data->link}}">{{$data->title}}</a></h3>
						<span class="label label-default">{{date('F j, Y', $data->pubDate)}}</span>
						<p>{{strip_tags($data->desc, '<img>')}}</p>
						<?php 
							$keys = $data->keywords;
							$keywords = explode(';', $keys);
						?>
						@foreach($keywords as $keyword)
							@if($keyword != '')
								<span class="badge">{{$keyword}}</span>
							@endif
						@endforeach
						<hr>
					</div>
				@endforeach
			</div>
			<div class="col-md-12 paginated" >
				{{$cat->xmlfeeddata()->paginate(15)->links()}}
			</div>
		</div>



	</div>
@endforeach

@endsection