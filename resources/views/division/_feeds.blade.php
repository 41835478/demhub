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

              <!-- $marginLeft += $width; -->

          @empty
          	<div class="color-label division_{{$currentDivision->slug}}"></div>
          @endforelse

          <div class="inner-feedsbox">
          <div class="article-background" style=
          <?php
          $neededSearchValue=$item->id;
          $neededObject = array_filter(
            $articleMediaArray,
            function ($e) use (&$neededSearchValue){
              if ($e->article_id == $neededSearchValue){
                return $e;

              }
            }
          );
          if (isset($neededObject[0])){
            echo '"background-image:url('.$neededObject[0]->filename.');
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
              margin-top:-19px;
              margin-left:-10px;
              margin-right:-10px;
              height:175px;
              background-position-y: 30%;
                                "';
          }
          else {
            echo '""';
          }
          ?>>
          <div style=
          @if (isset($neededObject[0]))
          "background-color:rgba(255, 255, 255, 0.6);height:175px;"
          @else
          ""
          @endif
          >
            <h3 class=
            @if (isset($neededObject[0]))
            "article-title-box" style="padding-top:55px"
            @else
            "" style="padding-top:37px"
            @endif
            >
              <a
                @if(Auth::check())
                  target="_blank" href="{{ $item->source_url }}"
                @else
                  href="" data-toggle="modal" data-target="#myModal"
                @endif
              style="color:#000">
              <?php
                if (strlen($item->title) > 66){
                  $str = substr($item->title, 0, 66) . '...';
                  echo $str;
                } else{
                  echo $item->title;
                }
              ?>
              </a>
            </h3>

            <span class=
            @if (isset($neededObject[0]))
            "article-title-box"
            @endif
            "" style="font-size:82%;color:#777777">
              {{ date_format(new DateTime($item->publish_date), 'j F Y | g:i a') }}
            </span>

            <span class=
            @if (isset($neededObject[0]))
            "article-title-box"
            @endif
            "" style="font-size:82%;color:#000;padding-left:5%">
            <?php
              $parse=parse_url($item->source_url);
              $host=$parse['host'];
              $host=substr($host,4);

              if (substr_count($host,".")>1){
                // $period=strpos($host,".");
                // $host=substr($host,$period+1);
              }
              else {
              echo '<a href="http://www.'.$host.'">'.$host.'</a>';
              }
            ?>
            </span>

          </div>
          </div>

            <p style="padding-top:10px">
              <?php
              $description = $item->excerpt;

                if (isset($neededObject[0]) && strlen($description) > 170){
                  $str = substr($description, 0, 170) . '...';
                  echo strip_tags($str);
                } else{
                  echo strip_tags($description);
                }
              ?>
            </p>
            <div style="bottom:50px; position:absolute;z-index:0.5;width:100%">
              <?php
              $articleKeywords = array_filter(preg_split("/\|/", $item->keywords));
              ?>
              @if(count($articleKeywords) > 4)
                @foreach($articleKeywords as $key=>$keyword)

                  @if($key==1)

                  <a class="label label-default" style="font-size:82%;margin-right:2px" href="/?query_term={{$keyword}}">
                    {{ $keyword }}
                  </a>
                  @elseif($key==2)

                  <div class="dropup" style="display:inline">
                    <a type="button" class="label label-default dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" id="dropdownMenu2" aria-expanded="false"
                    style="font-size:82%;margin-right:2px">
                    and {{count($articleKeywords)}} other keywords
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu label-default" aria-labelledby="dropdownMenu2">
                      <li><a href="?query_term={{$keyword}}">{{$keyword}}</a></li>
                    @elseif($key>2)
                      <li><a href="?query_term={{$keyword}}" >{{$keyword}}</a></li>

                  @endif
                @endforeach
                </ul>
              </div>
              @elseif(count($articleKeywords) <5)
                @foreach($articleKeywords as $key=>$keyword)
                  @if ($keyword)

                  <a class="label label-default" style="font-size:82%;margin-right:2px" href="?query_term={{$keyword}}">
                    @if($keyword == "virus")
                    viral
                    @else
                    {{ $keyword }}
                    @endif
                  </a>
                  @endif
                @endforeach

              @endif
            </div>
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
          </div>
        </div> <!-- the div that closes the box -->


    @endforeach

  </div>
</div>
