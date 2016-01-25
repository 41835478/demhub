<div class="container-fluid row">
	<h1>Activity feed</h1>

	<div id="activity-feed" class="col-xs-12 col-md-offset-3 col-md-6" data-page="0" data-url="">
		<?php // populated by jquery, takes partial render of _activity_feed_item view ?>
	</div>
</div>

<script>
	$(document).ready(function(){
		get_activities();
	});

	$("body").on("scroll", function(){		// this might be anything else depends on what container has the scroll bar
		if (jQuery(this).scrollTop() + jQuery(this).innerHeight() >= jQuery(this)[0].scrollHeight - 300) { //just a guess as starting point, has to be tested
			get_activities();
		}
	});

	function get_activities()
	{
		var activity_feed = $("#activity-feed");
		var current_page = activity_feed.attr("data-page");		// add this to the div when available
		var new_page =  parseInt(current_page)+1;
		$.ajax({
			type: "get",
			url: activity_feed.attr("data-url"),
			data: { page : new_page },
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
				//alert(response.msg);
				if (response.status == 'ok') {
					activity_feed.attr("data-page", new_page);
					$.each(response.data, function(index, value){
						activity_feed.append(value.html);
					});
				} else {
					
				}
			}
		});
	}
</script>
