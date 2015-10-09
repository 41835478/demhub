@extends('frontend.layouts.master')

@section('content')
	<div class="row">

		{{ $division->name }}

	</div><!-- row -->

	<div class="col-md-9 col-md-offset-1" style="overflow-x:hidden">

		<div id="ph-text" class="text-left">
			<?php
				$max = $news_feeds->get_item_quantity();
				for ($x = 0; $x < $max; $x++): $item = $news_feeds->get_item($x);
			?>

				<div class="col-md-12">
					<h3><a href="" data-toggle="modal" data-target="#myModal" style="color:#000">{{$item->get_title()}}</a></h3>

					<span class="label label-default" style="font-size:82%">{{$item->get_date('j F Y | g:i a')}}</span>
					<p>{{strip_tags($item->get_description(), '<img>')}}</p>
					<hr>
				</div>

			<?php endfor; ?>
		</div>

	</div>
@endsection

@section('after-scripts-end')
	<script>
		//Being injected from FrontendController
		console.log(test);
	</script>
@stop
