
@if(Request::url() == url('public_journal'))
  <?php $items=$publications; ?>
  @include('frontend.__content-card')
@elseif(strpos(Request::url(), "forum")!==false)
  <?php $items=$threads; ?>

  @include('frontend.__content-card')
@elseif(Request::url() == url('userhome') || strpos(Request::url(), "division")!==false )
  <?php $items=$newsFeeds; ?>
  @include('frontend.__content-card')
@elseif($newsFeeds)
    <?php $items=$newsFeeds; ?>
    @include('frontend.__content-card')
@elseif($publications)
    <?php $items=$publications; ?>
    @include('frontend.__content-card')
@elseif($threads)
    <?php $items=$threads; ?>
    @include('frontend.__content-card')
@endif
