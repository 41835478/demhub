<div class = "">



  <div {{ strpos(Request::url(), "profile")!==false ? 'class="col-xs-12 col-sm-6 col-md-4 col-lg-feed"' : ''}}>
    <?php
    if($item['subclass']=='publication'){ $item['url']='publication/'.$item['id'].'/view';}
    elseif($item['subclass']=='thread'){ $item['url']='forum/9-global/'.$item['id'].'-'.str_replace(' ','-',$item['name']);};
    
      $articleDivs = array_filter(preg_split("/\|/", $item['divisions']));
      if ($articleDivs) {
        sort($articleDivs);
        $height = 100/count($articleDivs);
        $marginTop = 0;
      }

    ?>

    <div class = "feedsbox-teaser">
      <div class="col-xs-1" style="height: 180px;margin-left:-15px;max-width:69px">
      @forelse($articleDivs as $div)
        <a style="height:{{$height}}%;" href="{{url('division', $allDivisions[$div-1]->slug)}}" class="color-label-vertical division_{{$allDivisions[$div-1]->slug}}"></a>
      @empty
        <a style="height:100%;" href="{{url('divisions')}}" class="color-label-vertical division_all"></a>
      @endforelse
      </div>

      <div class="col-xs-10 inner-feedsbox-teaser">

        <div class="article-background col-xs-3" style=
        <?php
        $neededSearchValue=$item["id"];
        if(isset($articleMediaArray)){
        $neededObject = array_filter(
          $articleMediaArray,
          function ($e) use (&$neededSearchValue){
            if ($e->article_id == $neededSearchValue){
              return $e;

            }
          }
        );
      }

        if (isset($neededObject[0])){
          echo '"background-image:url('.$neededObject[0]->filename.');
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            margin-top:8px;
            margin-left:-10px;
            margin-right:-10px;
            height:165px;
            background-position-y: 30%;
                              "';
        }
        else {
          echo '""';
        }
        ?>>
          <div {{ isset($neededObject[0]) ? 'style="background-color:rgba(200, 200, 200, 0.5);height:165px;"' : '' }}></div>
        </div>

        <h3 {{ isset($neededObject[0]) ? 'class="article-title-box article-link"' : '' }}
        style="padding-top:0px;margin-bottom:0px">
          <a
            @if(Auth::check())
              target="_blank"
              @if(Request::url() == url('userhome') || strpos(Request::url(), "division")!==false)
                href="{{ $item['url'] }}"
              @elseif(Request::url() == url('public_journal'))
                href="publication/{{ $item['id'] }}/view"
              @elseif(strpos(Request::url(), "forum")!==false)
                href="forum/9-global/{{ $item['id'] }}-{{ $item['slug'] }}"
              @endif
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
            // $_SERVER['REQUEST_URI'] = '/userhome' || strpos($_SERVER['REQUEST_URI'], "division")!==false
            if (isset($item['url']) && $item['subclass']=="article"){
              $parse=parse_url($item['url']);
              $host=$parse['host'];
              $host=substr($host,4);

              if (substr_count($host,".") <= 1){
                echo '<a target="_blank" href="http://www.'.$host.'">'.$host.'</a>';
              }
            }
            // else{
            //
            //   echo '<a target="_blank" href="http://www.'.$item['url'].'">'.gethostname().'</a>';
            // }
          ?>
        </span>

        <div {{ Request::url() == url('userhome') || strpos(Request::url(), "division")!==false ?
          'style="top:115px; position:absolute; width:100%;"' : 'style="position:absolute; width:100%;"' }} >

          <?php
          $keywords = array_filter(preg_split("/\|/", $item['keywords']));
          ?>
          @if(count($keywords) > 4)
            @include('division.__keyword-dropup-foreach')
          @elseif(count($keywords) <5)
            @foreach($keywords as $key=>$keyword)

              <a class="label label-card triangle-right" style="font-size:82%;margin-right:2px;padding-bottom:5px;" href="?query_term={{$keyword}}">
                {{ $keyword }}
              </a>


            @endforeach

          @endif
        </div>
        <div style="width:100%; height:42px; top:140px; position:absolute;">
          @include('division.__article_buttons')

          <div style="float:right;padding-right:8px;position:absolute;right:0px;top:0px;">
            <?php  $uploader=$author=Helpers::uploader($item); ?>

            @if (! empty($author))
            <a href="{{'profile/'.$author->user_name}}">
              <span>{{$author->full_name()}}<span>
              <img class="img-circle" style="height:35px;width:35px;" src="{{$author->avatar->url('thumb')}}">
            </a>
            @endif
          </div>

        </div>

      </div>

      </div>
    </div>



</div>
