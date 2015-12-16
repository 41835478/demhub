<div class="panel">

  <div class="panel-heading">
    <a href="{{ $url }}" style="display:block;">
      <span class="panel-title">{{ $title }}</span> <strong>({{$total}})</strong>
      <span class="panel-title pull-right">See More <i class="fa fa-caret-right"></i></span>
    </a>
  </div>

  <div class="panel-body">
    <table class="table">
      @include('frontend.search._'.$model.'_results')
    </table>
  </div>

</div>
