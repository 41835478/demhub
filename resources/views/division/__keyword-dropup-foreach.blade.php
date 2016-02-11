{{-- <?php
    dd($keywords);
    $dropup = false;
    if (count($keywords) > 3) {
        $dropup = true;
        die();
    }
?> --}}
{{-- Note :  --}}
{{-- First keyword is shown outside of dropup menu --}}
{{-- Same structure as facebook post 'like' count system --}}
@foreach($keywords as $index => $keyword)
    @if($index == 1)

        <a class="label-hashtag" style="font-size:82%;margin-right:2px;padding-bottom:4px;" href="/search?query_term={{$keyword}}">
            #{{ $keyword }}
        </a>
    @elseif($index == 2)
        {{-- Creates a keyword dropup menu  AND adds second keyword to the dropup--}}
        <div class="dropup" style="display:inline;">
            <a type="button" class="label-hashtag"
            data-toggle="dropdown" aria-haspopup="true" id="dropdownMenu2" aria-expanded="false"
            style="font-size:82%;margin-right:2px;padding-bottom:4px;">
                and {{count($keywords)-1}} other keywords
            <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
        <li><a href="/search?query_term={{$keyword}}">#{{$keyword}}</a></li>
    @elseif($index>2)
        {{-- Adds subsequent list items to keyword dropup menu --}}
        <li><a href="/search?query_term={{$keyword}}" >#{{$keyword}}</a></li>
    @endif
@endforeach
</ul>
</div>
