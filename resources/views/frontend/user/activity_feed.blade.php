@extends('frontend.layouts.master')

@section('content')
<div class="container-fluid row">
	<h1>Activity feed</h1>

	<div id="activity-feed" class="col-xs-12 col-sm-offset-2 col-sm-8" data-page="0" data-url="{{url('get_activities')}}" style="border:none">
		<?php // populated by jquery, takes partial render of _activity_feed_item view ?>
	</div>
</div>

<script>
	$(document).ready(function(){
		get_activities();
	});
	var timeOut = 0;
	$(window).on("scroll", function(){		// this might be anything else depends on what container has the scroll bar
		if (jQuery(this).scrollTop() + jQuery(this).innerHeight() >= jQuery(this)[0].scrollHeight - 300) { //just a guess as starting point, has to be tested
			get_activities();
		}
		var a = $("#activity-feed").offset().top;
		var b = $("#activity-feed").height();
		var c = $(window).height();
		var d = $(window).scrollTop();

		if ((c+d)>(a+b) && timeOut!==1) {
			get_activities();
			timeOut = 1;
			setTimeout(function(){timeout=0;},360);
		}
	});



	function get_activities()
	{
		var activity_feed = $("#activity-feed");
		var current_page = activity_feed.attr("data-page");		// add this to the div when available
		var new_page =  parseInt(current_page)+1;

		$.ajax({
			type: "get",
			url: activity_feed.attr("data-url")+"?page="+new_page,
			async: true,
			cache: true,
			beforeSend: function(){
				$(".loading").show();
			},
			complete: function(jqHXR, status){
				//
				$("#loading-content").fadeOut(200);
			},
			success: function(response) {
				activity_feed.append(response);
				activity_feed.attr("data-page", new_page);
				// if (response.status == 'ok') {
				// 	activity_feed.attr("data-page", new_page);
				// 	$.each(response.data, function(index, value){
				//
				// 	});
				// } else {
				//
				// }
			}
		});
	}
</script>
@endsection
