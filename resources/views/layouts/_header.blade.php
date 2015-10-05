<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DEMHUB - Disaster and Emergency Management Network</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

  <!--load custom CSS-->
  {!! HTML::style('css/template.css') !!}

  <!-- Load Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700,900' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <script type="text/javascript">
  	$(document).ready(function() {
  		$("i").hover(
  			function() {
  				$(this).tooltip('show');
  			},
  			function() {
  				$(this).tooltip('hide');
  			}
  		);

  	});
  </script>

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
</head>
