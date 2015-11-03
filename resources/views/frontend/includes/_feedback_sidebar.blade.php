<div id="dashboard-icon">
		<i class="fa fa-angle-double-right" data-toggle="tooltip" data-placement="right" title="Open Dashboard"></i>
	</div>
	<div id="dashboard">
		<ul class="list-unstyled">
		 <li>
			 <a href="">
				 <i class="fa fa-folder"></i> File Manager
			 </a>
		 </li>
		 <li>
			 <a href="">
				 <i class="fa fa-pencil-square-o"></i> Feedback
			 </a>
		 </li>
		</ul>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){

			$('div#dashboard-icon > i').click(function(){
				if ($('div#dashboard').css('marginLeft') < '0px'){
					$('div#dashboard').animate({
						marginLeft:0
					}, function(){
						$('div#dashboard-icon > i').removeClass();
						$('div#dashboard-icon > i').attr('data-original-title', 'Close Dashboard');
						$('div#dashboard-icon > i').addClass('fa fa-angle-double-left');
						$('div#dashboard-icon').css('left', '261px');
					});
				}
				else {
					$('div#dashboard').animate({
						marginLeft:-1000
					}, function(){
						$('div#dashboard-icon > i').removeClass();
						$('div#dashboard-icon > i').attr('data-original-title', 'Open Dashboard');
						$('div#dashboard-icon > i').addClass('fa fa-angle-double-right');
						$('div#dashboard-icon').css('left', '0');
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
