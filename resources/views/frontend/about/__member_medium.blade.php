<!-- MEMBER M
================================= -->
<div class="col-lg-3 col-md-4 col-sm-6">
  <div class="member">
      <div class="box">
    {!! HTML::image("images/about/team/".$imgName.".jpg", $name, ['class' => "img-circle", 'style' => 'width:250px;height:250px']) !!}
    <h3 style="{{ $imgName == "JenniferD" ? 'font-size:167%;font-weight: bold;padding-bottom:1px' : 'font-weight: bold;' }}">{{ $name }}</h3>
    <h4 style="{{ $imgName == "SeanK" ? 'font-size:117%;font-weight: lighter;padding-bottom:2px' : 'font-weight: lighter;' }}">{{ $position }}</h4>
    {{-- <h5 style="">{{ $description }}</h5> --}}
      </div>
  </div>
</div>
