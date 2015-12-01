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
      <div class="article-background" style="">
      <div style=
      @if (isset($neededObject[0]))
      "background-color:rgba(255, 255, 255, 0.6);height:175px;"
      @else
      ""
      @endif
      >
        <h3 class=
        @if (isset($neededObject[0]))
        "article-title-box article-link" style="padding-top:55px"
        @else
        "" style="padding-top:0px"
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
          echo '<a target="_blank" href="http://www.'.$host.'">'.$host.'</a>';
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
            }
            elseif (strlen($description) > 170){
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
        @include('division.__article_buttons')


      </div>
      </div>
    </div> <!-- the div that closes the box -->


@endforeach