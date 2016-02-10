<!-- MEMBER M
================================= -->
<div class="col-lg-3 col-md-4 col-sm-6">

      <div class="box" style="height:365px;float:center">
    {!! HTML::image("images/about/team/".$imgName.".jpg", $name, ['class' => "img-circle img-responsive", 'style' => 'max-width:100%;max-height:250px;margin: 0 auto']) !!}
    <h3 style="{{ $imgName == "JenniferD" ? 'font-size:167%;font-weight: bold' : 'font-weight: bold;' }}">{{ $name }}</h3>
    <h4 style="{{ $imgName == "SeanK" ? 'font-size:117%;font-weight: lighter' : 'font-weight: lighter;' }}">{{ $position }}</h4>
    {{-- <h5 style="">{{ $description }}</h5> --}}
      </div>

</div>
