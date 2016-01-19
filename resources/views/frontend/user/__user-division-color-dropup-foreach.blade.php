<?php $i=1; ?>
@foreach($divisions as $divSlug => $divName)

  @if($i==1)
  {{-- First keyword is shown outside of dropup menu --}}
  {{-- Same structure as facebook post like count system --}}
  <img style="width:10px;height:10px;margin-top:-3px;display:inline" src="/images/backgrounds/patterns/alpha_layer.png" class="img-square img-responsive division_{{ $divSlug }}">
  <span class="division-text_{{$divSlug}}">{{$divName}}</span>


  @elseif($i==2)
  {{-- Creates a keyword dropup menu  AND adds second keyword to the dropup--}}
  <div class="dropup" style="display:inline">
    <a type="button" class="dropdown-toggle"
    data-toggle="dropdown" aria-haspopup="true" id="dropdownMenu2" aria-expanded="false"
    style="font-size:82%;margin-right:2px;padding-right:20px;padding-left:20px">
    and {{count($divisions)-1}} other divisions
      <span class="caret"></span>
    </a>

    <ul class="dropdown-menu btn-default" aria-labelledby="dropdownMenu2" style="background-color: #fff !important;margin-left:10%;padding-right:10px;padding-left:10px">
      <li>
        <img style="width:12px;height:12px;margin-top:-3px;display:inline" src="/images/backgrounds/patterns/alpha_layer.png" class="img-square img-responsive division_{{ $divSlug }}">
        <span class="division-text_{{$divSlug}}">{{$divName}}</span>
      </li>
    @elseif($i>2)
    {{-- Adds subsequent list items to keyword dropup menu --}}
      <li>
        <img style="width:12px;height:12px;margin-top:-3px;display:inline" src="/images/backgrounds/patterns/alpha_layer.png" class="img-square img-responsive division_{{ $divSlug }}">
        <span class="division-text_{{$divSlug}}">{{$divName}}</span>
      </li>

  @endif
  <?php $i++; ?>
@endforeach
</ul>
</div>
