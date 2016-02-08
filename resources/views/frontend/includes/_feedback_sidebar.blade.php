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

    function sidebar(action)
    {
        var dashboard = $("#dashboard");
        if(action == "invite"){
            $("#feedbackForm").hide();
            $("#inviteForm").show();
            dashboard.addClass("open");
        } else if(action == "feedback"){
            $("#feedbackForm").show();
            $("#inviteForm").hide();
            dashboard.addClass("open");
        } else if(action == "close"){
            dashboard.removeClass("open");
        } else if(action == "toggle"){
            if(dashboard.hasClass("open")){
                dashboard.removeClass("open");
            } else {
                dashboard.addClass("open");
            }
        }
    }

	function feedbackFormUpdate(){
	  if($( "input:checked" ).length < 3) {
	  	$('#modalErrorButton').click();
	  } else {
	    $('#modalSuccessButton').click();
	  }
	}
</script>

<style>
    #dashboard.open{
        right: 0;
    }
</style>

<div class="btn-action" onclick="sidebar('invite')" data-toggle="tooltip" data-placement="top" title="Invite Your Colleagues">
    <i class="fa fa-plus fa-md"></i>
    <i class="fa fa-users fa-2x"></i>
</div>

<div id="invite-icon">
	<i class="fa fa-envelope-o" data-toggle="tooltip" data-placement="top" title="invite others" style="font-size:250%"></i>
</div>
<div id="dashboard-icon" onclick="sidebar('feedback')">
	<i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="left" title="feedback" style="font-size:250%"></i>
</div>

<div id="dashboard" class="animate text-center" style="padding: 120px 50px;">
	@include('forms.user.feedback')
	@include('forms.user.invite_people')
    <button class="btn btn-link" onclick="sidebar('close')">Close</button>
	<br>
</div>
