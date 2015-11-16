
<div class="modal fade" id="errorModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" style="text-align: center;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p><h4>Please correctly enter values into the registration fields.</h4></p>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="feedbackSuccessModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#feedbackSubmit').click()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">THANK YOU FOR THE FEEDBACK.</h3>
      </div>
      <div class="modal-body">
				  <h4>We're always trying to improve DEMHUB based on our user feedback.</h4>
      <div class="modal-footer" style="border-top: none; padding-top:0px;">

      <a type="button" id="feedbackSubmit" class="btn btn-default btn-style-alt" style="text-align:center" onclick="$('#feedbackSubmit').click()">SUBMIT</a>

      </div>
    </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script charset="utf-8">
  $(function() {
    function reposition() {
        var modal = $(this),
            dialog = modal.find('.modal-dialog');
        modal.css('display', 'block');

        // Dividing by two centers the modal exactly, but dividing by three
        // or four works better for larger screens.
        dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / (3)));
    }
    // Reposition when a modal is shown
    $('.modal').on('show.bs.modal', reposition);
    // Reposition when the window is resized
    $(window).on('resize', function() {
        $('.modal:visible').each(reposition);
    });
  });
</script>
