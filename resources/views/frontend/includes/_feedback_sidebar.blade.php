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
			$('div#dashboard-icon > i').addClass('fa fa-pencil-square-o');
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
function feedbackFormUpdate(){
  if($( "input:checked" ).length < 3) {
  // $("#sign-up-form").slideUp();
  $('#modalErrorButton').click();
  }
  else {
    $('#modalSuccessButton').click();
  }
}
</script>


<div id="dashboard-icon">
	<i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="left" title="FEEDBACK" style="font-size:250%"></i>
</div>

<div id="dashboard">
	@include('forms.user.feedback')
	<br>
</div>
