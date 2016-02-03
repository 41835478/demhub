@if (!url('userhome'))
  <div class="row">
    <div class="col-md-10 col-md-offset-2" style="overflow-x:hidden">
      <h2><span class="label label-info" style="background-color:rgba(0, 0, 0, 0.7);">NEWS FEED</span><h2>
    </div>
  </div>
@else
  <div style="padding-bottom:20px"></div>
@endif

<div class="container-fluid">
  <div class="row">
    @foreach($newsFeeds as $item)
      @include('frontend.card._card')
    @endforeach
  </div>
</div>
