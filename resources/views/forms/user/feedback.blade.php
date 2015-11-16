<div class="row">
<div style="padding-left:45px" class="col-xs-11">
<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{route('post_feedback')}}" data-toggle='validator' data-delay='1100'>
  <!--App details-->
  <div class="form-group" style="color:#fff">
    <label for="question1">Overall, are you finding DEMHUB useful?</label><br>
    <label style="font-size:50%">1 - lowest, 5 - highest</label><br>
    <?php
      for($x = 1; $x < 6; $x++){
        echo '<label class="radio-inline">
              <input type="radio" class="form" id="question1" name="question1" required value="'.$x.'">'.$x.'</label>';
      }
    ?>
    <div class="help-block"></div>
  </div>
  <br>
  <div class="form-group" style="color:#fff">
    <label for="question2">Do you like the layout of the site?</label><br>
    <label style="font-size:50%">1 - lowest, 5 - highest</label><br>
    <?php
      for($x = 1; $x < 6; $x++){
        echo '<label class="radio-inline">
              <input type="radio" class="form" id="question2" name="question2" required value="'.$x.'">'.$x.'</label>';
      }
    ?>
    <div class="help-block"></div>
  </div>
  <br>
  <div class="form-group" style="color:#fff">
    <div class="input-group">
    <label for="question3">Did you find the site easy to navigate?</label><br>
    <label style="font-size:50%">1 - lowest, 5 - highest</label><br>
    <?php
      for($x = 1; $x < 6; $x++){
        echo '<label class="radio-inline">
              <input type="radio" class="form" id="question3" name="question3" required value="'.$x.'">'.$x.'</label>';
      }
    ?>
  </div>
    <div class="help-block"></div>
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
  <button type="button" class="btn btn-default btn-style" onclick="feedbackFormUpdate()">DONE</a>
    <button type="button" id="modalSuccessButton" class="btn btn-default" data-toggle="modal" data-target="#feedbackSuccessModal" style="display:none">MODAL S</button>
    <button type="button" id="modalErrorButton" class="btn btn-default" data-toggle="modal" data-target="#errorModal" style="display:none">MODAL ERROR</button>
    <button type="submit" id="feedbackSubmit" class="btn btn-default btn-style" style="display:none">SUBMIT</button>
  </div>

    {!! Form::token() !!}
</form>
</div>
</div>
