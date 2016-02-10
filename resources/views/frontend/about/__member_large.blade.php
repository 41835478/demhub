<!-- MEMBER L
================================= -->
{{-- @if($imgName == "JenniferD")
<div class="col-sm-12" style="padding:50px 20px">
@else
<div class="col-sm-6" style="padding:50px 20px">
@endif --}}
  <div class="member">
    {!! HTML::image("images/about/team/".$imgName.".jpg", $name, ['class' => "mask-large"]) !!}
    <h3 style="font-weight: bold;">{{ $name }}</h3>
    <h4 style="font-weight: lighter;">{{ $position }}</h4>
    {{-- <h5 style="">{{ $description }}</h5> --}}
  </div>
</div>
