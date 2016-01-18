@if($newsFeeds)
  <?php $items=$newsFeeds; ?>
  @include('frontend.__content-card')
@elseif($publications)
  <?php $items=$publications; ?>
  
@elseif($threads)
  <?php $items=$threads; ?>

@endif
