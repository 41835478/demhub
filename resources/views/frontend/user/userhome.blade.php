
@extends('frontend.layouts.master')

@section('content')


	<!-- <div class="row">
		<div class="col-md-12">

	    <h1></h1>

    </div>
</div>
    <div class="row text-center">

		</div>

		<div class="row" style="padding:2%;">
			<div class="col-md-12">

			</div>
		</div> -->

	    <div class="col-md-12 text-right">
			<!-- <h5>Arrange by</h5>
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
			</ul> -->
		</div>

<div class="row">
	<div class="col-md-9 col-md-offset-1" style="overflow-x:hidden">

		<div id="ph-text" class="text-left">
			<?php
				$max = $newsFeeds->get_item_quantity();
				for ($x = 0; $x < $max; $x++): $item = $newsFeeds->get_item($x);
			?>

				<div class="col-md-12">
					<h3><a target="_blank" href="{{$item->get_link()}}" style="color:#000">{{$item->get_title()}}</a></h3>

					<span class="label label-default" style="font-size:82%">
						{{$item->get_date('j F Y | g:i a')}}
					</span>
					<p>
						<?php
							$description = $item->get_description();

							if (strlen($description) > 250){
								$str = substr($description, 0, 250) . '...';
								echo strip_tags($str, '<img>');
							} else{
								echo strip_tags($description, '<img>');
							}

						?>
					 </p>
					<hr>
				</div>

			<?php endfor; ?>
		</div>

	</div>
</div>

@endsection('content')
