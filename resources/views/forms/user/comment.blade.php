<form id="comment" class="form" enctype="multipart/form-data" method="post" action="{{url('comment', array('id' => $id))}}">

  <!--App details-->
  	<div class="form-group">
	    <label for="comment"></label>
	    <textarea class="form-control" name="comments" placeholder="Write a comment...max 150 characters." rows="3"></textarea>
	</div>
  <div class="form-group">
    <button type="submit"  class="btn btn-default">Post Comment</button>
  </div>
  {{Form::token()}}
</form>