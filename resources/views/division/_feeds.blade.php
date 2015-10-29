<div class="row">

<div class="col-md-10 col-md-offset-2" style="overflow-x:hidden">
    <h2><span class="label label-info" style="background-color:rgba(0, 0, 0, 0.7);">NEWS FEED</span><h2>
  </div>
</div>
  <div class="row">

  <div class="col-md-10 col-md-offset-1" style="overflow-x:hidden;padding-left:7%">

    @foreach($newsFeeds->get_items($start, $length) as $index => $item)

      @if(!isset($pattern) || isset($pattern) && (preg_match($pattern, $item->get_title()) == true || preg_match($pattern, $item->get_description()) == true) )

        <div class = "feedsbox">

        <div class ="color-label_{{$currentDivision->slug}}"></div>

          <div style="width: 90%; height: 90%; margin-left:15px; margin-right:25px;">

          <h3>
            <a
              @if(Auth::check())
                target="_blank" href="{{ $item->get_link() }}"
              @else
                href="" data-toggle="modal" data-target="#myModal"
                @endif
            style="color:#000">
            {{ $item->get_title() }}
            </a>
          </h3>

          <span class="label label-default" style="font-size:82%">
            {{$item->get_date('j F Y | g:i a')}}
          </span>

          <?php
            $description = $item->get_description();
            if (preg_match_all('/(https?:\/\/\S+\.(?:jpg|png|gif))\s+/', $description, $img)){
              echo '<img class="img-responsive">'.$img[0][0].'</img>';
            }
          ?>

          <p style="padding-top:10px">
            <?php
            $description = $item->get_description();
              if (strlen($description) > 150){
                $str = substr($description, 0, 150) . '...';
                echo strip_tags($str, '<img>');
              } else{
                echo strip_tags($description, '<img>');
              }
            ?>
          </p>

<div style="width:100%; height:50px; bottom:0px; position:absolute;">

              <button type="button" class="btn btn-default" aria-label="Left Align" style="background-color:red;color:#fff;" data-toggle="popover"
              data-content="Feed successfully added to your favourite">


      <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    </button>

    <button type="button" class="btn btn-default btn-sm" style="margin-left:5px;">
      <div class="glyphicon glyphicon-thumbs-up" aria-hidden="true"> xxx</div>
    </button>



    <button type="button" class="btn btn-default btn-sm" style="margin-left:5px;">
      <div class="glyphicon glyphicon-share-alt" aria-hidden="true"></div>
    </button>


        <a button type="button" class="btn btn-default btn-sm" style="margin-left:5px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
          <div class="glyphicon glyphicon-comment" aria-hidden="true"> xxx</div>
        </button></a>
        <ul class="dropdown-menu" aria-labelledby="dLabel" style="width:100%; heigth:auto; margin-left:-30px; padding: 15px 15px 15px 15px;">
        <li>Place Holder
        </li>
        <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr </p>
        <hr>
        <li>Place Holder
        </li>
        <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr </p>
        <hr>
        <li>Place Holder
        </li>
        <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr </p>
        <hr>

        <div class="form-group">
          <input type="text" class="form-control" placeholder="Comment" style="width:100%; height: 100px;">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>

      </ul>

</div>
        </div>
      </div> <!-- the div that closes the box -->
      @endif

    @endforeach

</div>
</div>
<div class="row">
<div class="col-md-10 col-md-offset-2" style="overflow-x:hidden">
    <p>Showing <?php echo $begin; ?>&ndash;<?php echo $end; ?> out of <?php echo $max; ?> |
      <?php echo $prevlink; ?> | <?php echo $nextlink; ?> |
      <a href="<?php echo '?start=' . $start . '&length=5'; ?>">5</a>
      <a href="<?php echo '?start=' . $start . '&length=10'; ?>">10</a>
      <a href="<?php echo '?start=' . $start . '&length=20'; ?>">20</a> at a time.
    </p>
  </div>
</div>
