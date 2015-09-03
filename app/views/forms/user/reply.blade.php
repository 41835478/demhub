<form id="comment" class="form" enctype="multipart/form-data" method="post" action="{{URL::route('post-reply', array('id' => $discussion->id))}}">

  <!--App details-->
  	<div class="form-group">
	    <label for="reply">Reply</label>
	    <textarea class="form-control" name="reply" placeholder="Write a reply..." rows="4"></textarea>
	</div>
  <div class="form-group">
    <button type="submit"  class="btn btn-info">Post Reply</button>
  </div>
  {{Form::token()}}
</form>