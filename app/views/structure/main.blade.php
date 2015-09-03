@include('structure.header')
@if (Auth::user())

	<div id="dashboard-icon">
		<i class="fa fa-angle-double-right" data-toggle="tooltip" data-placement="right" title="Open Dashboard"></i>
	</div>
	<div id="dashboard">
		 @include('user.menu-user.dashboard-icons')
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

@endif


<div class="container-fluid">


	@include ('guest.menu-user.user')
	@include ('user.menu-user.function')

	@if(Session::has('success'))
	<div class="col-md-6 col-md-offset-6">
		<div id="message" class="alert alert-success alert-dismissible text-center" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			{{Session::get('success')}}
		</div>
	</div>
	@endif

	@if(Session::has('error'))
	<div class="col-md-6 col-md-offset-6">
		<div id="message" class="alert alert-danger alert-dismissible text-center" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			{{Session::get('error')}}
		</div>
	</div>
	@endif
	

	@yield('content')


</div>


@include('structure.footer')