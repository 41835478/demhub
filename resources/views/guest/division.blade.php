@extends('layouts.master')

@section('content')

	<script>
		$(document).ready(function(){
			$("div#ph-text > p").find('br').remove();
			$("div#ph-text > p").find('a').remove();
		});
	</script>

	@foreach($category as $cat)
		<nav>
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
							<h1 style="background:#{{$cat->bg_color}}">{{$cat->category_name}}</h1>
						</div>
					</div>

				</div>

			</div>
		</nav>

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

		<div class="col-md-9 col-md-offset-1 text-left" id="discussion">
			<h2 style="color:#{{$cat->bg_color}};font-size:170%">DISCUSSION</h2>
			<hr style="border-color:#{{$cat->bg_color}};">
		</div>

		<div class="col-md-9 col-md-offset-1">
			<div class="col-md-12 paginated" >
				{!! $discussions->appends(array('item' => 'discussion'))->render() !!}
			</div>
			<div id="ph-text" class="col-md-12 text-left">
				@foreach($discussions as $data)
					<h3>{{$data->discussion_title}}</h3>
					<span class="label label-default">
						<small>Last updated: </small>
						{{date('F j, Y', strtotime($data->updated_at))}}
					</span>
					<p>{{$data->discussion_paragraph}}</p>
					<hr>
				@endforeach
			</div>
		</div>

		<div class="modal fade" id="myModal" style="padding-top:100px">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-body">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h3>You can access the articles once you <a type="button" class="btn btn-default btn-style-alt" data-dismiss="modal" href="{{url('sign-up')}}">SIGN UP</a></h3>
					</div>

				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div class="col-md-9 col-md-offset-1 text-left" id="news">
			<h2 style="color:#{{$cat->bg_color}};"> NEWS</h2>
			<hr style="border-color:#{{$cat->bg_color}};">
		</div>

		<div class="col-md-9 col-md-offset-1" style="overflow-x:hidden">

			<div id="ph-text" class="text-left">
			  <?php
			    $max = $feed->get_item_quantity();
			    for ($x = 0; $x < $max; $x++): $item = $feed->get_item($x);
			  ?>

			    <div class="col-md-12">
			      <h3><a href="" data-toggle="modal" data-target="#myModal" style="color:#000">{{$item->get_title()}}</a></h3>

			      <span class="label label-default" style="font-size:82%">{{$item->get_date('j F Y | g:i a')}}</span>
			      <p>{{strip_tags($item->get_description(), '<img>')}}</p>
			      <?php
			        $keys = $data->keywords;
			        $keywords = explode(';', $keys);
			      ?>
			      <hr>
			    </div>

			  <?php endfor; ?>
			</div>

		</div>

	@endforeach

@endsection