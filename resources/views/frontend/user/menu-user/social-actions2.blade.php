
<div class="col-md-8 col-md-offset-2" >
	<ul id="social" class="list-inline">
		<li class="like">
			<a href="{{url('like', array('id' => $feed->id))}}">
				<i class="fa fa-chevron-up" data-toggle="tooltip" data-placement="top" title="Like"></i>
			</a>
			<span class="badge">{{count($feed->getLikes)}}</span>
		</li>
		<li class="dislike">
			<a href="{{url('dislike', array('id' => $feed->id))}}">
				<i class="fa fa-chevron-down" data-toggle="tooltip" data-placement="top" title="Dislike"></i>
			</a>
			<span class="badge">{{count($feed->getDislikes)}}</span>
		</li>
		<li class="comment">
			<a>
				<i id="comment_{{$feed->id}}" class="fa fa-comments" data-toggle="tooltip" data-placement="top" title="Comment"></i>
			</a>
			<span class="badge">
				{{count($feed->getComments)}}
			</span>
		</li>
	</ul>
</diV>
<div id="comment_{{$data->id}}" aria-expanded="false" class="col-md-12 collapse">
	<div class="row">
		<div class="col-md-4 col-md-offset-2">
			@include('forms.user.comment', array('id' => $feed->id))
			<hr>
		</div>
	</div>
	
		
			@foreach($feed->getComments as $comments)
				@if ($comments->xml_category_feed_id == $feed->id)
				<div class="row">	
					<div class="col-md-8 col-md-offset-2">
						<p class="text-muted text-left">{{$comments->comment}}</p>
						<span class="text-primary">By: {{$comments->getUser->user_name}}</span><br>
						<span class="text-warning">{{date('F j, Y, g:i a', strtotime($comments->updated_at))}}</span>
						<hr>
					</div>
					<div class="col-md-2">
						<ul class="list-inline">
							<li><i class="fa fa-flag"></i></li>
							<li><i class="fa fa-pencil"></i></li>
							<li><i class="fa fa-trash"></i></li>
						</ul>
					</div>
				</div>
				@endif
				
			@endforeach
	
	
	
</div>

<script type="text/javascript">

	$("ul#social > li > a > i").click(function(){
		var id = $(this).attr('id');
		$("div#"+id+"").collapse('toggle');
	});

</script>