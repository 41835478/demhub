@if(! is_array($item) && get_class($item) == "App\Models\Publication")
    <?php $pub = $item ?>
    @if(Auth::user()->has_bookmarked_publication($pub))
        {!! Form::model($pub, ['route' => ['unbookmark_publication', $pub->id],
            'id' => "form-{$pub->id}", 'class' => 'js-bookmark', 'style' => 'display: inline;', 'role' => 'form', 'method' => 'POST']) !!}
            {{-- <button type="submit" class="btn btn-greytone btn-sm" style="height: 30px; width: 120px">
                <span class="bookmark-tag">
                    <i class="glyphicon glyphicon-ok"></i> UNBOOKMARK
                </span>
                <div class="loader" style="display:none">Loading...</div>
            </button> --}}
            <button type="submit" class="btn btn-greytone btn-sm" style="width:34px; height:30px;" aria-label="Left Align" data-toggle="popover" data-content="Feed successfully added to your favourite">
                <span class="js-bookmark-tag glyphicon glyphicon-ok" aria-hidden="true"></span>
                <div class="js-loader loader" style="display:none;">Loading...</div>
            </button>
        {!! Form::close() !!}
    @else
        {!! Form::model($pub, ['route' => ['bookmark_publication', $pub->id],
            'id' => "form-{$pub->id}", 'class' => 'js-bookmark', 'style' => 'display: inline;', 'role' => 'form', 'method' => 'POST']) !!}
            {{-- <button type="submit" class="btn btn-style-alt btn-sm" style="height: 30px; width: 120px">
                <span class="bookmark-tag">
                    <i class="glyphicon glyphicon-plus"></i> BOOKMARK
                </span>
                <div class="loader" style="display:none">Loading...</div>
            </button> --}}
            <button type="submit" class="btn btn-style-alt btn-sm" style="width:34px; height:30px;" aria-label="Left Align" data-toggle="popover" data-content="Feed successfully removed from your favourite">
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
    <button type="button" class="btn btn-greytone btn-sm" style="margin-left:5px;"  aria-haspopup="true" aria-expanded="false" disabled>
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

<div class="btn-group dropup" onmouseenter="twitterActivate(this)">
    @if(Auth::user())
        <button type="button" class="btn btn-greytone btn-sm share-dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
        style="margin-left:5px;">
            <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a class="article_twitter" href="https://twitter.com/share" data-hashtags="DEMHUBnetwork" data-text="{{$item['name']}}"
            data-url="<?php if ($item['subclass'] !== 'article' && $item['subclass'] !== 'infoResource') {
                echo url('').'/';
            }; echo $item['url']; ?>">TWEET</a></li>
            <li><a href="mailto:?Subject=DEMHUB%20News%20Article&amp;body=Found%20this%20article%20on%20DEMHUB%0D%0A%0D%0A{{$item['name']}}%0D%0A{{$item['url']}}"
            target="_top" class="article_email">EMAIL</a></li>
            <li role="separator" class="divider"></li>
            <li><a><span>
                <?php if ($item['subclass'] !== 'article' && $item['subclass'] !== 'infoResource') {
                    echo substr(url(''), 7).'/';
                }; echo $item['url']; ?>
            </span></a></li>
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
