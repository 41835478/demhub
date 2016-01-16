<div class="modal fade" id="publicationModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="text-align:center">
        <h3 style="display:inline">{{ $publication->title() }}</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="text-align:center">
        <div class="row">
          @include('frontend.user.dashboard.my_publication._publication_details_listing')
        </div>
        <div class="row">
          <a class="btn btn-style-alt" type="button" style="margin-right:10px;text-transform:uppercase" href="{{ URL::to('publication/' . $publication->id . '/view') }}">show</a>
          <a class="btn btn-style-alt" type="button" style="margin-right:10px;text-transform:uppercase" href="{{ URL::to('my_publication/' . $publication->id . '/edit') }}">edit</a>
          <a class="btn btn-style-alt" type="button" style="text-transform:uppercase" href="{{route('publications')}}">PUBLICATIONS</a>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
