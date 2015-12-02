<div class="modal fade" id="DEMHUBModal" style="padding-top:100px">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">{{ trans('modals.register_title') }}</h3>
      </div>

      <div class="modal-body">
        @include('forms.auth._register')
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
