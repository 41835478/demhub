<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>DEMHUB - Disaster and Emergency Management Network</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--load custom CSS-->
	{{HTML::style('css/template.css')}}


	@include('structure.server')
<script type="text/javascript">

	$(document).ready(function(){
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

<body>


