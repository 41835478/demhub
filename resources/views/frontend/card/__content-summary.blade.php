<?php
    use App\Http\Components\Helpers;

    if($item['subclass']=='publication'){ $item['url']='publication/'.$item['id'].'/view';}
    elseif($item['subclass']=='thread'){ $item['url']='forum/9-global/'.$item['id'].'-'.str_replace(' ','-',$item['name']);}

    $width = 100;
    if(count($item['divisions']) > 0) {
        $width = 100 / count($item['divisions']);
    }

?>

<div class="feedsbox">

    @forelse($item['divisions'] as $slug => $div)
        <div class="color-label division_{{$slug}} col-xs-6"
            style="width:{{$width}}%; margin:0;"
            data-toggle="headsup" data-placement="top" title="{{$div}}">
        </div>
    @empty
        <div class="color-label division_all" data-toggle="headsup" data-placement="top" title="All Divisions"></div>
    @endforelse

    <div class="inner-peoplebox" style="padding-bottom: 100px;">
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
                }

                if (isset($neededObject[0])){
                    $link = $neededObject[0]->filename;
                    $diff = strlen($link)-14;
                    $substr = substr($link,$diff);
                    $check =strpos($substr,'x');
                    if($check){
                        $check =strpos($substr,'-');
                        $link = substr($link,0,-(14-$check)).'.jpg';
                    };
                  echo '"background-image:url('.$link.');
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
                    if(isset($parse['host'])){
                        $host=$parse['host'];
                        $host=substr($host,4);

                        if (substr_count($host,".") <= 1){
                            echo '<a target="_blank" href="http://www.'.$host.'">'.$host.'</a>';
                        }
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
                } else{
                    echo strip_tags($description);
                }
            ?>
        </p>

        <div>
            @if(count($item['keywords']) > 4)
                @include('division.__keyword-dropup-foreach', ['keywords'=>$item['keywords']])
            @elseif(count($item['keywords']) <5)
                @foreach($item['keywords'] as $key => $keyword)
                    <a class="label-hashtag" style="font-size:82%;margin-right:2px;padding-bottom:4px" href="{{ url('search', ['query_term'=>$keyword]) }}">
                        #{{ $keyword }}
                    </a>
                @endforeach
            @endif
        </div>

    </div> <!-- the div that closes the .inner-peoplebox -->

    <div style="width:100%; bottom:0px; position:absolute;">
        <div class="col-xs-12">
            @include('frontend.card.__article_buttons')
        </div>

        <div class="col-xs-12" style="padding: 15px; background-color: #f5f5f5; margin: 10px 0 0 0;">
            <?php  ($item['subclass']=='article') ? : $author=Helpers::uploader($item); ?>

            @if (! empty($author))
                <a href="{{'profile/'.$author->user_name}}" style="color: black;">
                    <img class="img-circle pull-left" style="height:35px;width:35px;margin-right: 10px;" src="{{$author->avatar->url('thumb')}}" \>
                    <div class="pull-left">
                        <h5 class="text-uppercase">{{$author->full_name()}}<h5>
                        <h6>{{$author->job_title}}</h6>
                    </div>
                </a>
            @endif
        </div>
    </div>
</div> <!-- the div that closes the .feedsbox -->
