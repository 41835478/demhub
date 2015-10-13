@extends('frontend.layouts.master')

@section('content')

<nav>
	<div id="welcome-division">

		<div id="welcome-division-category" class="row" style="background:
																url('../images/backgrounds/divisions/all.jpg') no-repeat fixed 0% 70%;
																-webkit-background-size: cover;
																-moz-background-size: cover;
																-o-background-size: cover;
																background-size: cover;
																overflow: hidden;"
																>
			<div class="row" style="padding-top:52px;">
				<div id="welcome-division-menu" class="col-xs-12" style="opacity: 0.75;filter: alpha(opacity=75);padding:0px;">
					@foreach($navDivisions as $category)

						<a href="{{url('division', array('id' => $category->slug))}}">
							<div id="division_{{$category->id}}" style="opacity: 0.75;filter: alpha(opacity=75);background-color: #{{$category->bg_color}};min-height:67px;max-height:67px" class="col-md-2">
								<p style="text-align:center;padding-top:11px;text-transform:uppercase;">{{$category->name}}</p>
							</div>
						</a>

					@endforeach

				</div>
			</div>

			<div class="row">
				<div id="ph-name" class="col-md-4 col-md-offset-8 text-center" style="opacity: 0.75;filter: alpha(opacity=75)">
					<h1 style="background:#FFF">ALL DIVISIONS</h1>
				</div>
			</div>

		</div>

	</div>
</nav>

		<div class="modal fade" id="myModal" style="padding-top:100px">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-body">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h3>You can access the articles once you <a type="button" class="btn btn-default btn-style-alt" data-dismiss="modal" href="{{URL::route('sign-up')}}">SIGN UP</a></h3>
					</div>

				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

<div class="col-md-9 col-md-offset-1" style="overflow-x:hidden">

	<div id="ph-text" class="text-left">
		<?php
			$max = $newsFeeds->get_item_quantity();
			for ($x = 0; $x < $max; $x++): $item = $newsFeeds->get_item($x);
		?>

			<div class="col-md-12">

				<h3><a href="" data-toggle="modal" data-target="#myModal" style="color:#000">{{$item->get_title()}}</a></h3>

				<span class="label label-default" style="font-size:82%">{{$item->get_date('j F Y | g:i a')}}</span>
				<p><?php
					$description = $item->get_description();

						 if (strlen($description) > 150){

							$str = substr($description, 0, 150) . '...';
					echo strip_tags($str, '<img>');
					}
					 else{

					echo strip_tags($description, '<img>');
					}

					 ?></p>
				<hr>
			</div>

		<?php endfor; ?>
	</div>

</div>

@stop
