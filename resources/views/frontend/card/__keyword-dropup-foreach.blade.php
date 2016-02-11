<?php
    $dropup = false;
    $keyword_show_limit = 3;
    $keywords_count = count($keywords);
    if ($keywords_count > $keyword_show_limit) {
        $dropup = true;
    }
?>

{{-- Note : Same structure as facebook post 'like' count system --}}
@foreach($keywords as $index => $keyword)
    @if(!$dropup || ($index == 1 && $dropup))
        {{-- First (few) keyword(s) is shown outside of dropup menu --}}
        <a class="label-hashtag" style="font-size:82%;margin-right:2px;padding-bottom:4px;" href="/search?query_term={{$keyword}}">
            #{{ $keyword }}
        </a>
    @elseif($dropup && $index == 2)
        {{-- Creates a keyword dropup menu  AND adds second keyword to the dropup--}}
        <div class="dropup" style="display:inline;">
            <a type="button" class="label-hashtag"
                data-toggle="dropdown" aria-haspopup="true" id="dropdownMenu2" aria-expanded="false"
                style="font-size:82%;margin-right:2px;padding-bottom:4px;"
            >
                and {{count($keywords)-1}} other keywords
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <li><a href="/search?query_term={{$keyword}}">#{{$keyword}}</a></li>
    @elseif($dropup && ($keyword == end($keywords))) {{-- End of list --}}
                <li><a href="/search?query_term={{$keyword}}" >#{{$keyword}}</a></li>
            </ul>
        </div>
    @else
        <li><a href="/search?query_term={{$keyword}}" >#{{$keyword}}</a></li>
    @endif
@endforeach
