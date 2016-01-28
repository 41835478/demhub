@if(Request::url() == url('public_journal'))
  <?php $items=$publications; ?>

@elseif(strpos(Request::url(), "forum")!==false)
  <?php $items=$threads; ?>


@elseif(Request::url() == url('userhome') || strpos(Request::url(), "division")!==false )
  <?php $items=$newsFeeds; ?>

@elseif($newsFeeds)
    <?php $items=$newsFeeds; ?>

@elseif($publications)
    <?php $items=$publications; ?>

@elseif($threads)
    <?php $items=$threads; ?>

@endif

@foreach($items as $item)
  @include('frontend.__content-teaser')
@endforeach
