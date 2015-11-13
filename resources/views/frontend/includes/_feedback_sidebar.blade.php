<script type="text/javascript">
$(document).ready(function(){

$('div#dashboard-icon > i').click(function(){

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
			$('div#dashboard-icon > i').addClass('glyphicon glyphicon-flag');
			$('div#dashboard-icon').css('right', '0');
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
</script>

<div id="dashboard-icon">
	<i class="glyphicon glyphicon-flag" data-toggle="tooltip" data-placement="left" title="FEEDBACK"></i>
</div>

<div id="dashboard">
	@include('forms.user.feedback')
	<br>
	<br>
</div>
@include('modals._feedback_thankyou')
