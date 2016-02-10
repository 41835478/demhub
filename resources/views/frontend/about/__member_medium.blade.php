<!-- MEMBER M
================================= -->
<div class="col-lg-3 col-md-4 col-sm-6">
  <div class="member">
      <div class="box">
    {!! HTML::image("images/about/team/".$imgName.".jpg", $name, ['class' => "img-circle", 'style' => 'width:250px;height:250px']) !!}
    <h3 {{ $imgName == "JenniferD" ? 'style="font-size:90%;font-weight: bold"' : 'style="font-weight: bold;"' }}>{{ $name }}</h3>
    <h4 style="font-weight: lighter;">{{ $position }}</h4>
    {{-- <h5 style="">{{ $description }}</h5> --}}
      </div>
  </div>
</div>
