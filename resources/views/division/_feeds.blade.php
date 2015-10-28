<div class="row">

<div class="col-md-7 col-md-offset-2" style="overflow-x:hidden">
  <div class="row" >
    <h2><span class="label label-info" style="background-color:rgba(0, 0, 0, 0.7);">NEWS FEED</span><h2>
  </div>
  <div id="ph-text" class="text-left">

    @foreach($newsFeeds->get_items($start, $length) as $item)

      @if(!isset($pattern) || isset($pattern) && (preg_match($pattern, $item->get_title()) == true || preg_match($pattern, $item->get_description()) == true) )

        <div class="row">
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
              if (strlen($description) > 225){
                $str = substr($description, 0, 225) . '...';
                echo strip_tags($str, '<img>');
              } else{
                echo strip_tags($description, '<img>');
              }
            ?>
          </p>

          <hr>
        </div>

      @endif

    @endforeach

  </div>
  <p>Showing <?php echo $begin; ?>&ndash;<?php echo $end; ?> out of <?php echo $max; ?> |
    <?php echo $prevlink; ?> | <?php echo $nextlink; ?> |
    <a href="<?php echo '?start=' . $start . '&length=5'; ?>">5</a>
    <a href="<?php echo '?start=' . $start . '&length=10'; ?>">10</a>
    <a href="<?php echo '?start=' . $start . '&length=20'; ?>">20</a> at a time.</p>

</div>
</div>
