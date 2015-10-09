<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{url('upload')}}">

  <!--App details-->
  <div class="form-group">
    <label for="fileupload"></label>
    <input type="file" name="fileupload" placeholder="Upload a File" />
  </div>
  <div class="form-group">
    <button type="submit"  class="btn btn-default">Submit</button>
  </div>
  {{Form::token()}}
</form>