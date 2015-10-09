
<div class="col-md-12 text-center" >
	<ul id="social" class="list-inline">
		<li class="like">

			<a style="color:#{{$feed->getcategory->bg_color}}" href="{{url('like', array('id' => $feed->id))}}">
				<i class="fa fa-thumbs-up" data-toggle="tooltip" data-placement="top" title="Like"></i>
			</a>
			<span style="color:#{{$feed->getcategory->bg_color}}" class="badge">
				{{count($feed->getLikes)}}
			</span>
		</li>
		<li class="dislike">
			<a style="color:#{{$feed->getcategory->bg_color}}" href="{{url('dislike', array('id' => $feed->id))}}">
				<i class="fa fa-thumbs-down" data-toggle="tooltip" data-placement="top" title="Dislike"></i>
			</a>
			<span style="color:#{{$feed->getcategory->bg_color}}" class="badge">
				{{count($feed->getDislikes)}}
			</span>
		</li>
		<li class="comment">
			<a style="color:#{{$feed->getcategory->bg_color}};">
				<i id="comment_{{$feed->id}}" class="fa fa-commenting" data-toggle="tooltip" data-placement="top" title="Comment"></i>
			</a>
			<span style="color:#{{$feed->getcategory->bg_color}}" class="badge">
				{{count($feed->getComments)}}
			</span>
		</li>
	</ul>
</diV>
<div id="comment_{{$feed->id}}" aria-expanded="false" class="col-md-12 collapse">
	<div class="row">
		<div class="col-md-12">
			@include('forms.user.comment', array('id' => $feed->id))
			<hr>
		</div>
	</div>
	
		
			@foreach($feed->getComments as $comments)
				@if ($comments->xml_category_feed_id == $feed->id)
				<div class="row">	
					<div class="col-md-11 col-md-offset-1">
						{!! HTML::image('images/user/'.$comments->getUser->avatar->file_name.'', 
							        ''.$comments->getUser->user_name.' icon', 
							        array(
							          'class' => 'user-icon img-responsive',
							          'style' => 'width:20%; display:inline;'
							        )
							)!!}
						<span style="margin-left:2%;"class="text-muted">
							{{$comments->getUser->user_name}}
						</span><br>
						<p class="text-left">{{$comments->comment}}</p>
						
						<span class="text-warning"><small>{{date('F j, Y, g:i a', strtotime($comments->updated_at))}}</small></span>
						<hr>
					</div>
					<!-- <div class="col-md-2">
						<ul class="list-inline">
							<li><i class="fa fa-flag"></i></li>
							<li><i class="fa fa-pencil"></i></li>
							<li><i class="fa fa-trash"></i></li>
						</ul>
					</div> -->
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