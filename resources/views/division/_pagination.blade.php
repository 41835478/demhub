<?php
  $begin = ($options_page - 1) * $options_count + 1;
  $end = $begin + $item_count - 1;

  $hrefNext = '?page=' . ($options_page + 1);
  $hrefNext = empty($query_term) ? $hrefNext : $hrefNext . '&query_term=' . $query_term;

  $hrefPrev = '?page=' . ($options_page - 1);
  $hrefPrev = empty($query_term) ? $hrefPrev : $hrefPrev . '&query_term=' . $query_term;

  $nextlink = '<a href="' . $hrefNext . '">Next &raquo;</a>';
  $prevlink = '<a href="' . $hrefPrev . '">&laquo; Previous</a>';
?>

<div class="row">
  <div class="col-md-10 col-md-offset-2" style="overflow-x:hidden">
    <p>Showing
      <?php echo $begin; ?>&ndash;<?php echo $end; ?>
      out of <?php echo $total_count; ?>
      @if($options_page != 1)
        | <?php echo $prevlink; ?>
      @endif

      @if($last_page == false)
        | <?php echo $nextlink; ?>
      @endif
    </p>
  </div>
</div>
