<!-- Main Footer -->
<footer class="main-footer">
  <p> &nbsp; </p>
  <p align="center">
    {!! link_to('policy', trans('strings.policy')) !!} |
    {!! link_to('terms', trans('strings.terms')) !!}
  </p>
  <p align="center">
    <strong>Copyright &copy; <?php
      $copyYear = 2015;
      $curYear = date('Y');
      echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
      ?>
    {!! link_to('', 'DEMHUB Inc') !!}.</strong> {{ trans('strings.all_rights_reserved') }}
  </p>
</footer>
