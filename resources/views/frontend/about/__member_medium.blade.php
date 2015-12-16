<!-- MEMBER M
================================= -->
<div class="col-lg-3 col-md-3 col-sm-6">
  <div class="member">
    {!! HTML::image("images/about/team/".$imgName.".jpg", $name, ['class' => "img-rounded"]) !!}
    <h3 style="font-weight: bold;">{{ $name }}</h3>
    <h4 style="font-weight: lighter;">{{ $position }}</h4>
    <h5 style="">{{ $description }}</h5>
  </div>
</div>
