@if(Request::url() == url('public_journal'))
  <?php $items=$publications; ?>
  @include('frontend.__content-teaser')
@elseif(strpos(Request::url(), "forum")!==false)
  <?php $items=$threads; ?>
  @include('frontend.__content-teaser')
@elseif(Request::url() == url('userhome') || strpos(Request::url(), "division")!==false )
  <?php $items=$newsFeeds; ?>
  @include('frontend.__content-teaser')
@endif
