@if (! url('userhome'))
  <div class="row">
    <div class="col-md-10 col-md-offset-2" style="overflow-x:hidden">
      <h2><span class="label label-info" style="background-color:rgba(0, 0, 0, 0.7);">NEWS FEED</span><h2>
    </div>
  </div>
@else
  <div style="padding-bottom:20px"></div>
@endif

<div class="container-fluid">
  <div class="row">

    @foreach($newsFeeds as $item)
      <div class="col-xs-12 col-sm-6 col-md-4">

        <?php
          $articleDivs = array_filter(preg_split("/\|/", $item->divisions));
          if ($articleDivs) {
            sort($articleDivs);
            $width = 100/count($articleDivs);
            $marginLeft = 0;
          }
        ?>

        <div class = "feedsbox">

          @forelse($articleDivs as $div)
            <a style="width:{{$width}}%; margin-left:{{$marginLeft}}%;" href="{{url('division', $allDivisions[$div-1]->slug)}}" class="color-label division_{{$allDivisions[$div-1]->slug}} col-xs-6"></a>
            <?php
              $marginLeft += $width;
            ?>
          @empty
          	<div class="color-label division_{{$currentDivision->slug}}"></div>
          @endforelse

          <div class="inner-feedsbox">
            <h3>
              <a
                @if(Auth::check())
                  target="_blank" href="{{ $item->source_url }}"
                @else
                  href="" data-toggle="modal" data-target="#myModal"
                @endif
              style="color:#000">
              <?php
                if (strlen($item->title) > 65){
                  $str = substr($item->title, 0, 65) . '...';
                  echo $str;
                } else{
                  echo $item->title;
                }
              ?>
              </a>
            </h3>

            <span class="label label-default" style="font-size:82%">
              {{ date_format(new DateTime($item->publish_date), 'j F Y | g:i a') }}
            </span>

            <?php
              $description = $item->excerpt;
              if (preg_match_all('/(https?:\/\/\S+\.(?:jpg|png|gif))\s+/', $description, $img)){
                echo '<img class="img-responsive">'.$img[0][0].'</img>';
              }
            ?>

            <p style="padding-top:10px">
              <?php
              $description = $item->excerpt;
                if (strlen($description) > 180){
                  $str = substr($description, 0, 180) . '...';
                  echo strip_tags($str);
                } else{
                  echo strip_tags($description);
                }
              ?>
            </p>

            <div onclick="comingSoon(this.id)" id="article_{{$item->id}}" style="width:100%; height:42px; bottom:0px; position:absolute;">

              <button type="button" class="btn btn-default btn-style-alt" aria-label="Left Align" data-toggle="popover" data-content="Feed successfully added to your favourite" disabled>
                <span class="glyphicon glyphicon-plus" aria-hidden="true" style="color:#000"></span>
              </button>

              <!-- <button type="button" class="btn btn-default btn-sm" style="margin-left:5px;">
                <div class="glyphicon glyphicon-thumbs-up" aria-hidden="true"> xxx</div>
              </button> -->

              <button type="button" class="btn btn-default btn-sm" style="margin-left:5px;" disabled>
                <div class="glyphicon glyphicon-share-alt" aria-hidden="true"></div>
              </button>

              <a button type="button" class="btn btn-default btn-sm" style="margin-left:5px;"  aria-haspopup="true" aria-expanded="false" disabled>
                <div class="glyphicon glyphicon-comment" aria-hidden="true"> DISCUSS</div>
              </a>

              <!-- data-toggle="dropdown" -->
              <ul class="dropdown-menu" aria-labelledby="dLabel" style="width:100%; heigth:auto; margin-left:-30px; padding: 15px 15px 15px 15px;">
                <li>Place Holder</li>
                <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr </p>
                <hr>
                <li>Place Holder</li>
                <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr </p>
                <hr>
                <li>Place Holder</li>
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

      </div>
    @endforeach

  </div>
</div>
