<script type="text/javascript">
	$(document).ready(function(){
		$("#feedbackForm").hide();
		$("#inviteForm").hide();
		$('div#dashboard-icon > i').click(function(){
			$("#inviteForm").hide();
			$("#feedbackForm").show();
			if ($('div#dashboard').css('right') == '-350px'){
				$('div#dashboard').animate({
					right:'0px'
				}, function(){
					$('div#dashboard-icon > i').removeClass();
					$('div#dashboard-icon > i').addClass('fa fa-angle-double-right');
					$('div#dashboard-icon').css('right', '350px');
				});
			}
			else if ($('div#dashboard').css('right') == '0px'){
				$('div#dashboard').animate({
					right:'-350px'
				}, function(){
					$('div#dashboard-icon > i').removeClass();
					$('div#dashboard-icon > i').addClass('fa fa-pencil-square-o');
					$('div#dashboard-icon').css('right', '0');
				});
			}
		});

		$('#invite-icon').click(function(){
			$("#feedbackForm").hide();
			$("#inviteForm").show();
			if ($('#dashboard').css('right') == '-350px'){
				$('#dashboard').animate({
					right:'0px'
				}, function(){
					$('#invite-icon > i').removeClass();
					$('#invite-icon > i').addClass('fa fa-angle-double-right');
					$('#invite-icon').css('right', '350px');
				});
			}
			else if ($('#dashboard').css('right') == '0px'){
				$('#dashboard').animate({
					right:'-350px'
				}, function(){
					$('#invite-icon > i').removeClass();
					$('#invite-icon > i').addClass('fa fa-envelope-o');
					$('#invite-icon').css('right', '0');
				});
			}
		});

		$("i").hover(
			function(){
				$(this).tooltip('show');
			}, function() {
				$(this).tooltip('hide');
			}
		);

	});

	function feedbackFormUpdate(){
	  if($( "input:checked" ).length < 3) {
	  	$('#modalErrorButton').click();
	  } else {
	    $('#modalSuccessButton').click();
	  }
	}
</script>

<div id="invite-icon">
	<i class="fa fa-envelope-o" data-toggle="tooltip" data-placement="top" title="invite others" style="font-size:250%"></i>

</div>
<div id="dashboard-icon">
	<i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="left" title="feedback" style="font-size:250%"></i>
</div>



<div id="dashboard">
	@include('forms.user.feedback')
	@include('forms.user.invite_people')
	<br>
</div>
