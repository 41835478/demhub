@if(!is_array($item) || (is_array($item) && isset($item['subclass'])))
    {{-- TODO - Change form to remove model binding and deal with bookmarks as arrays --}}
    <?php
        $subclass = NULL;
        if (is_array($item)) {
            $subclass = $item['subclass'];
            $item = \App\Models\Content::find($item['id']);
        } else {
            $subclass = $item->subclass;
        }
    ?>
    @if(Auth::user()->has_bookmarked_content($item, $subclass))
        {!! Form::model(
            $item, ['route' => ['unbookmark_content', $item->id, $subclass],
            'id' => "form-{$item->id}", 'class' => 'js-bookmark',
            'style' => 'display: inline;', 'role' => 'form', 'method' => 'POST']
        ) !!}
            <button type="submit" class="btn btn-greytone btn-sm" style="width:34px; height:30px;">
                <span class="js-bookmark-tag glyphicon glyphicon-ok" aria-hidden="true"></span>
                <div class="js-loader loader" style="display:none;">Loading...</div>
            </button>
        {!! Form::close() !!}
    @else
        {!! Form::model(
            $item, ['route' => ['bookmark_content', $item->id, $subclass],
            'id' => "form-{$item->id}", 'class' => 'js-bookmark',
            'style' => 'display: inline;', 'role' => 'form', 'method' => 'POST']
        ) !!}
            <button type="submit" class="btn btn-style-alt btn-sm" style="width:34px; height:30px;">
                <span class="js-bookmark-tag glyphicon glyphicon-plus" aria-hidden="true"></span>
                <div class="js-loader loader" style="display:none;">Loading...</div>
            </button>
        {!! Form::close() !!}
    @endif
@else
    <button type="button" class="btn btn-greytone btn-sm" aria-label="Left Align" data-toggle="popover" data-content="Feed successfully added to your favourite" disabled>
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    </button>
@endif


    <div class="btn-group">
        <?php
        $discussions =$item->check_for_article_discussions();

         ?>


        <a type="button" class="btn btn-greytone btn-sm" style="margin-left:5px;" <?php echo ($item['subclass']=='thread') ? 'href="'.Helpers::route($item).'"' : 'aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"' ?>>
            <div class="glyphicon glyphicon-comment" aria-hidden="true"> DISCUSS</div>
        </a>


        <ul class="dropdown-menu" aria-labelledby="dLabel">
            @if($discussions)
                @foreach($discussions as $discussion)

                    <li><a href="<?php echo strpos(Request::url(), 'forum') == false ? 'forum/' : ''; ?> {{ Helpers::route($discussion)}}">
                        <?php

                            if (strlen($discussion['name']) > 66){
                                $str = substr($discussion['name'], 0, 66) . '...';
                                echo $str;
                            } else{
                                echo $discussion['name'];
                            }
                        ?>
                    </a></li>
                    
                @endforeach
            @endif

            <li>
                <a href="{{url('content-thread/'.$item['id'])}}">CREATE THREAD</a></li>
        </ul>
    </div>

<div class="btn-group dropup" onmouseenter="twitterActivate(this)">
    @if(Auth::user())
        <button type="button" class="btn btn-greytone btn-sm share-dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
        style="margin-left:5px;">
            <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
        </button>
        <ul class="dropdown-menu" >
            <li><a class="article_twitter" href="https://twitter.com/share" data-hashtags="DEMHUBnetwork" data-text="{{$item['name']}}"
            data-url="<?php if ($item['subclass'] !== 'article' && $item['subclass'] !== 'infoResource') {
                echo url('').'/';
            }; echo $item['url']; ?>">TWEET</a></li>
            <li><a href="mailto:?Subject=DEMHUB%20News%20Article&amp;body=Found%20this%20article%20on%20DEMHUB%0D%0A%0D%0A{{$item['name']}}%0D%0A{{$item['url']}}"
            target="_top" class="article_email">EMAIL</a></li>
            <li role="separator" class="divider"></li>
            <li><a><input
                value="<?php if ($item['subclass'] !== 'article' && $item['subclass'] !== 'infoResource') {
                    echo substr(url(''), 7).'/';
                }; echo $item['url']; ?>">
            </a></li>
            {{-- <li><a class="copy-button" ><span class="glyphicon glyphicon-link" aria-hidden="true"> </span><span class="copy-button-text"> Copy Link</span>
            <span class="copy-button-link" style="display:none">{{$item['url']}}</span></a></li> --}}
        </ul>
    @else
        <a type="button" class="btn btn-default btn-sm" href="" data-toggle="modal" data-target="#DEMHUBModal"
        style="margin-left:5px;">
            <div class="glyphicon glyphicon-share-alt" aria-hidden="true"></div>
        </a>
    @endif
</div>
