@if($newsFeeds)
  <?php $items=$newsFeeds; ?>
  @include('frontend.__content-teaser')
@elseif($publications)
  <?php $items=$publications; ?>
  @include('frontend.__content-teaser')
@elseif($threads)
  <?php $items=$threads; ?>
  @include('frontend.__content-teaser')
@endif
