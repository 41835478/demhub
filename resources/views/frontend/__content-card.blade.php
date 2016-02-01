<?php
  if($item['subclass']=='publication'){ $item['url']='publication/'.$item['id'].'/view';}
  elseif($item['subclass']=='thread'){ $item['url']='forum/9-global/'.$item['id'].'-'.str_replace(' ','-',$item['name']);};

  $articleDivs = array_filter(preg_split("/\|/", $item['divisions']));
  if ($articleDivs) {
    sort($articleDivs);
    $width = 100/count($articleDivs);
    $marginLeft = 0;
  }
?>

<div class="col-xs-12 col-lg-feed">

  <div class = "feedsbox" style="{{--isset($articleMediaArray) ? 'height:510px;' : 'height:340px;'--}}">

    @forelse($articleDivs as $div)
      <div class="color-label division_{{$allDivisions[$div-1]->slug}} col-xs-6"
        style="width:{{$width}}%; margin-left:{{$marginLeft}}%;"
        data-toggle="headsup" data-placement="top" title="{{$allDivisions[$div-1]->slug}}">
      </div>
    @empty
      <div class="color-label division_all" data-toggle="headsup" data-placement="top" title="All Divisions"></div>
    @endforelse

    <div class="inner-peoplebox" style="padding-bottom: 50px;">
      <div class="article-background" style=
        <?php
          $neededSearchValue=$item["id"];
          if (isset($articleMediaArray)){
            $neededObject = array_filter(
              $articleMediaArray,
              function ($e) use (&$neededSearchValue){
                if ($e->article_id == $neededSearchValue){
                  return $e;
                }
              }
            );
          };

          if (isset($neededObject[0])){
            echo '"background-image:url('.$neededObject[0]->filename.');
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
              margin-top:8px;
              margin-left:-10px;
              margin-right:-10px;
              height:230px;
              background-position-y: 30%;"';
          } else {
            echo '""';
          }
        ?>
      >
        <div {{ isset($neededObject[0]) ? 'style="background-color:rgba(200, 200, 200, 0.5);height:230px;"' : '' }}></div>
      </div>

      <h3 {{ isset($neededObject[0]) ? 'class="article-title-box article-link"' : '' }}
      style="padding-top:0px;margin-bottom:0px">
        <a
          @if(Auth::check())
            target="_blank" href="{{ $item['url'] }}"
          @else
            href="" data-toggle="modal" data-target="#DEMHUBModal"
          @endif
          class="main-blue-color">
          <?php
            if (strlen($item['name']) > 66){
              $str = substr($item['name'], 0, 66) . '...';
              echo $str;
            } else{
              echo $item['name'];
            }
          ?>
        </a>
      </h3>

      <span {{ isset($neededObject[0]) ? 'class="article-title-box"' : '' }}
        style="font-size:82%;color:#777777;">
        {{ date_format(new DateTime($item['publish_date']), 'j F Y | g:i a') }}
      </span>

      <span {{ isset($neededObject[0]) ? 'class="article-title-box"' : ''}}
        style="font-size:82%;color:#000;padding-left:5%">
        <?php
          if ($item['subclass']=='article'){

            $parse=parse_url($item['url']);
            $host=$parse['host'];
            $host=substr($host,4);

            if (substr_count($host,".") <= 1){
              echo '<a target="_blank" href="http://www.'.$host.'">'.$host.'</a>';
            }
          }
        ?>
      </span>

      <p style="padding-top:10px">
        <?php
          $description = $item['description'];
          if (isset($neededObject[0]) && strlen($description) > 127){
            $str = substr($description, 0, 127) . '...';
            echo strip_tags($str);
          }
           else{
            echo strip_tags($description);
          }
        ?>
      </p>

	  <div style="">

		  <?php
		  $keywords = array_filter(preg_split("/\|/", $item['keywords']));
		  ?>
		  @if(count($keywords) > 4)
		  @include('division.__keyword-dropup-foreach')
		  @elseif(count($keywords) <5)
		  @foreach($keywords as $key => $keyword)
		  <a class="label-hashtag" style="font-size:82%;margin-right:2px;padding-bottom:4px" href="?query_term={{$keyword}}">
			  #{{ $keyword }}
		  </a>
		  @endforeach
		  @endif
	  </div>

      <div style="width:100%; height:42px; bottom:0px; position:absolute;">
        @include('division.__article_buttons')
      </div>
    </div> <!-- the div that closes the .inner-peoplebox -->

  </div> <!-- the div that closes the .feedsbox -->

</div> <!-- the div that closes the box -->
