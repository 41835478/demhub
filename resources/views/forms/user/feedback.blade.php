<div class="row">
<div style="padding-left:45px;color:#fff" class="col-xs-11">
<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{route('post_feedback')}}">
  <!--App details-->
  <div class="form-group">
    <label for="question1">Are you getting value from DEMHUB?</label><br>
    <label style="font-size:50%">0 - lowest, 5 - highest</label><br>
    <?php
      for($x = 0; $x < 6; $x++){
        echo '<label class="radio-inline">
              <input type="radio" class="form" name="question1" value="'.$x.'">'.$x.'</label>';
      }
    ?>

  </div>
  <br>
  <div class="form-group">
    <label for="question2">What did you use DEMHUB for?</label><br>
    {!! Form::select('question2', array('0' => 'Select One','Explore the platform' => 'Explore the platform',
    'Industry specific needs' => 'Industry specific needs', 'News' => 'News', 'Track Events' => 'Track Events',
    'Communciation' => 'Communication', 'Access resources' => 'Access resources',
    'Documentary sharing' => 'Documentary sharing', 'Other' => 'Other'),'0', array('class' => 'form-control')) !!}

  </div>
  <br>
  <div class="form-group">
    <label for="question3">How can we improve DEMHUB?</label>
    <textarea class="form-control" rows="3" name="question3" placeholder="Answer...."></textarea>
  </div>

  <div class="form-group">
    <button type="submit"  class="btn btn-default btn-style">SUBMIT</button>
  </div>

    {!! Form::token() !!}
</form>
</div>
</div>
