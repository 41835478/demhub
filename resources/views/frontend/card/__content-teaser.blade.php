<div {{ strpos(Request::url(), "profile")!==false ? 'class="col-xs-12 col-sm-6 col-md-4 col-lg-feed"' : ''}}>

    <?php
        if($item['subclass']=='publication'){ $item['url']='publication/'.$item['id'].'/view';}
        elseif($item['subclass']=='thread'){ $item['url']='forum/9-global/'.$item['id'].'-'.str_replace(' ','-',$item['name']);};

        //$articleDivs = array_filter(preg_split("/\|/", $item['divisions']));
        // if ($articleDivs) {
        //   sort($articleDivs);
        //   $height = 100/count($articleDivs);
        //   $marginTop = 0;
        // }
        //
        $height = 100;
        if(count($item['divisions']) > 0) {
            $height = 100 / count($item['divisions']);
        };
    ?>

    <!-- Begin: feedsbox-teaser -->
    <div class = "feedsbox-teaser">

        <div class="col-xs-1" style="height: 145px;margin-left:-15px;max-width:30px">
            @forelse($item['divisions'] as $slug => $div)
                <div style="height:{{$height}}%;" class="color-label-vertical division_{{$slug}}"
                data-toggle="tooltip" data-placement="top" title="{{$div}}">
                </div>
            @empty
                <div style="height:100%;" class="color-label-vertical division_all"
                data-toggle="tooltip" data-placement="top" title="All Divisions">
                </div>
            @endforelse
        </div>

        <!-- Begin: inner-feedsbox-teaser -->
        <div class="col-xs-10 inner-feedsbox-teaser">

            <div class="article-background col-xs-3" style=
                <?php
                    $neededSearchValue=$item["id"];
                    if (isset($articleMediaArray)) {
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
                          background-position-y: 30%;"';
                    } else {
                        echo '""';
                    }
                ?>
            >
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
                if (isset($item['url']) && $item['subclass']=="article"){
                  $parse=parse_url($item['url']);
                  $host=$parse['host'];
                  $host=substr($host,4);

                  if (substr_count($host,".") <= 1){
                    echo '<a target="_blank" href="http://www.'.$host.'">'.$host.'</a>';
                  }
                }
                ?>
            </span>

            <div {{ Request::url() == url('userhome') || strpos(Request::url(), "division")!==false ?
            'style="top:115px; position:absolute; width:100%;"' : 'style="position:absolute; width:100%;"' }} >
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

        </div> <!-- End: inner-feedsbox-teaser -->

        <div style="width:100%; position:absolute; bottom: 0; padding: 10px 15px">
            @include('division.__article_buttons')

            <div style="float:right;padding-right:8px;position:absolute;right:0px;top:8px;">
                <?php $uploader = $author = Helpers::uploader($item); ?>

                @if (!empty($author))
                    <a href="{{'profile/'.$author->user_name}}">
                        <span>{{$author->full_name()}}<span>
                        <img class="img-circle" style="height:35px;width:35px;" src="{{$author->avatar->url('thumb')}}" \>
                    </a>
                @endif
            </div>
        </div>

    </div> <!-- End: feedsbox-teaser -->

</div>
