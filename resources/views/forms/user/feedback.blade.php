<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{url('feed-back')}}">

  <!--App details-->
  <div class="form-group">
    <label for="question1">1. Question.....1</label><br>
    <?php 
      for($x = 1; $x < 6; $x++){
        echo '<label class="radio-inline">
              <input type="radio" class="form" name="question1" value="'.$x.'">'.$x.'</label>';
      }
    ?>
   
  </div>
  <hr>
  <div class="form-group">
    <label for="question2">2. Question.....2</label><br>
    <?php 
      for($x = 1; $x < 6; $x++){
        echo '<label class="radio-inline">
              <input type="radio" class="form" name="question2" value="'.$x.'">'.$x.'</label>';
      }
    ?>
   
  </div>
  <hr>
  <div class="form-group">
    <label for="question3">3. Question.......3</label>
    <textarea class="form-control" rows="3" name="question3" placeholder="Answer...."></textarea>
  </div>
  <div class="form-group">
    <button type="submit"  class="btn btn-default">Submit</button>
  </div>
  {!! Form::token() !!}
</form>