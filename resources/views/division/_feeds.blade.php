
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
            "article-title-box article-link" style="padding-top:55px"
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
            <div style="width:100%; height:42px; bottom:0px; position:absolute;">

              <button type="button" class="btn btn-default btn-style-alt" aria-label="Left Align" data-toggle="popover" data-content="Feed successfully added to your favourite" disabled>
                <span class="glyphicon glyphicon-plus" aria-hidden="true" style="color:#000"></span>
              </button>

              <!-- <button type="button" class="btn btn-default btn-sm" style="margin-left:5px;">
                <div class="glyphicon glyphicon-thumbs-up" aria-hidden="true"> xxx</div>
              </button> -->
              <div class="btn-group dropup">
                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                 style="margin-left:5px;">
                  <div class="glyphicon glyphicon-share-alt" aria-hidden="true"></div>
                </button>
                <ul class="dropdown-menu">
                 <li><a class="article_twitter" href="https://twitter.com/share" data-hashtags="DEMHUBnetwork" data-text="{{$item->title}}"
                 data-url="{{$item->source_url}}">TWEET</a> </li>
                 <li><a href="mailto:?Subject=DEMHUB%20News%20Article&amp;body=Found%20this%20article%20on%20DEMHUB%0D%0A%0D%0A{{$item->title}}%0D%0A{{$item->source_url}}"
                   target="_top" class="article_email">EMAIL</a></li>
                 <li role="separator" class="divider"></li>
                 <li><button type="button" class="btn btn-style copy-button" ><span class="glyphicon glyphicon-link" aria-hidden="true"> </span><span class="copy-button-text"> Double Click To Copy</span>
                   <span class="copy-button-link" style="display:none">{{$item->source_url}}</span></button></li>
                </ul>
              </div>
              <div class="btn-group">
              <button type="button" class="btn btn-default btn-sm" style="margin-left:5px;"  aria-haspopup="true" aria-expanded="false" disabled>
                <div class="glyphicon glyphicon-comment" aria-hidden="true"> DISCUSS</div>
              </button>

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
          </div>
        </div> <!-- the div that closes the box -->


    @endforeach
    <!-- Twitter Button Javascript -->
<script>
var twitterElement;
var newScript;
var copyLink;
$(".feedsbox").mouseenter(function() {
  twitterElement=$(this).find(".article_twitter");
  $(twitterElement).addClass("twitter-share-button");
  copyLink=$(this).find(".copy-button");
  $(copyLink).attr('id', 'copy-button');
  copyLink=$(this).find(".copy-button-text");
  $(copyLink).attr('id', 'copy-button-text');
  copyLink=$(this).find(".copy-button-link");
  $(copyLink).attr('id', 'copy-button-link');

  !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(document.body){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');

});
// function toggleMenuOff() {
//   var Toggle=("#copy-button").parent(".dropdown-toggle");
//   $(Toggle).attr("data-toggle","");
// }
// function toggleMenu() {
//   // element.closest(".dropdown-toggle");
//   //  $(element).children('ul').stop().slideToggle(400);
//   //  $(element).dropdown("toggle");
//   $('#copy-button').preventDefault();
// }
$(".copy-button").click(function(e){
  $("#copy-button").preventDefault();
});

$(".feedsbox").mouseleave(function() {
  copyLink=$(this).find(".copy-button");
  $(copyLink).attr('id', '');
  copyLink=$(this).find(".copy-button-text");
  $(copyLink).attr('id', '');
  copyLink=$(this).find(".copy-button-link");
  $(copyLink).attr('id', '');

});
$(document).ready(function () {
  $(".copy-button").zclip({
	        path:"js/ZeroClipboard.swf",
	        copy:function(){return $("#copy-button-link").text();},
      beforeCopy: function () {

                  console.log('hello');
                },
			afterCopy:function(){
				document.getElementById("copy-button-text").innerHTML=" Copied To Clipboard";
        setInterval(function(){
        toggle.click();
        },500);
			}
	});
  // $(".copy-button").click(function(){
  //     alert($("#copy-button-link").text());
  // });
});




</script>

  </div>
</div>
