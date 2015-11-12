<div class="row">
<div style="padding-left:45px" class="col-xs-11">
<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{route('post_feedback')}}">
  <!--App details-->
  <div class="form-group" style="color:#fff">
    <label for="question1">Overall, are you finding DEMHUB useful?</label><br>
    <label style="font-size:50%">0 - lowest, 5 - highest</label><br>
    <?php
      for($x = 0; $x < 6; $x++){
        echo '<label class="radio-inline">
              <input type="radio" class="form" name="question1" value="'.$x.'">'.$x.'</label>';
      }
    ?>

  </div>
  <br>
  <div class="form-group" style="color:#fff">
    <label for="question2">Do you like the layout of the site?</label><br>
    <label style="font-size:50%">0 - lowest, 5 - highest</label><br>
    <?php
      for($x = 0; $x < 6; $x++){
        echo '<label class="radio-inline">
              <input type="radio" class="form" name="question2" value="'.$x.'">'.$x.'</label>';
      }
    ?>

  </div>
  <br>
  <div class="form-group" style="color:#fff">
    <label for="question3">Did you find the site navigation?</label><br>
    <label style="font-size:50%">0 - lowest, 5 - highest</label><br>
    <?php
      for($x = 0; $x < 6; $x++){
        echo '<label class="radio-inline">
              <input type="radio" class="form" name="question3" value="'.$x.'">'.$x.'</label>';
      }
    ?>

  </div>
  <br>
  <!-- <div class="form-group">
    <label for="question3">What did you use DEMHUB for?</label><br>
    {!! Form::select('question3', array('0' => 'Select One','Explore the platform' => 'Explore the platform',
    'Industry specific needs' => 'Industry specific needs', 'News' => 'News', 'Track Events' => 'Track Events',
    'Communciation' => 'Communication', 'Access resources' => 'Access resources',
    'Uploading & sharing' => 'Uploading & sharing', 'Other' => 'Other'),'0', array('class' => 'form-control')) !!}

  </div> -->
  <div class="form-group" style="color:#fff">
    <label for="question4">Any recommendations to improve the site?</label>
    <textarea class="form-control" rows="3" name="question4" placeholder="Answer...."></textarea>
  </div>
  <div class="form-group">
  <button type="button" class="btn btn-default btn-style" data-toggle="modal" data-target="#feedbackModal">DONE</a>
  <button type="submit" id="feedbackSubmit" class="btn btn-default btn-style" style="display:none">SUBMIT</button>
  </div>

    {!! Form::token() !!}
</form>
</div>
</div>
