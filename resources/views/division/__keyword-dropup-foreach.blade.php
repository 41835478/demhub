@foreach($keywords as $index=>$keyword)

  @if($index==1)
  {{-- First keyword is shown outside of dropup menu --}}
  {{-- Same structure as facebook post like count system --}}
  <a class="label label-default" style="font-size:82%;margin-right:2px" href="/?query_term={{$keyword}}">
    {{ $keyword }}
  </a>
  @elseif($index==2)
  {{-- Creates a keyword dropup menu  AND adds second keyword to the dropup--}}
  <div class="dropup" style="display:inline">
    <a type="button" class="label label-default dropdown-toggle"
    data-toggle="dropdown" aria-haspopup="true" id="dropdownMenu2" aria-expanded="false"
    style="font-size:82%;margin-right:2px">
    and {{count($keywords)}} other keywords
      <span class="caret"></span>
    </a>
    <ul class="dropdown-menu label-default" aria-labelledby="dropdownMenu2">
      <li><a href="?query_term={{$keyword}}">{{$keyword}}</a></li>
    @elseif($index>2)
    {{-- Adds subsequent list items to keyword dropup menu --}}
      <li><a href="?query_term={{$keyword}}" >{{$keyword}}</a></li>

  @endif
@endforeach
</ul>
</div>
