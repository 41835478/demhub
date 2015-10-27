
<div class="row" style="padding-top:52px;">
	<div id="welcome-division-menu" class="col-xs-12" style="opacity: 0.75;filter: alpha(opacity=75);padding:0px;">
		@foreach($allDivisions as $category)
			<a href="{{url('division', array('slug' => $category->slug))}}">
				<div id="division_{{$category->id}}" style="opacity: 0.75;filter: alpha(opacity=75);background-color: #{{$category->bg_color}};min-height:67px;max-height:67px" class="col-md-2">
					<p style="text-align:center;padding-top:11px;text-transform:uppercase;">{{$category->name}}</p>
				</div>
			</a>
		@endforeach

</div>
</div>

<div class="row">
	<div class="col-md-8" style="max-height:500px;overflow-y:hidden;padding:0px">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="max-height:500px">
  <!-- Indicators -->
  <ol class="carousel-indicators">
	<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	@foreach($allDivisions as $category)
    <li data-target="#carousel-example-generic" data-slide-to="{{$category->id}}"></li>
	@endforeach
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="./images/backgrounds/bridge.jpg" class="img-responsive" alt="" style="">
      <div class="carousel-control" style="opacity: 1;filter: alpha(opacity=100);padding-left:200px;padding-top:20px">
      	<p>WELCOME<font style="visibility:hidden">*</font>TO<font style="visibility:hidden">*</font>DEMHUB!</p>
      </div>
    </div>
		@foreach($allDivisions as $category)
    <div class="item">
	<a href="{{url('division', array('slug' => $category->slug))}}">
      <img src="./images/backgrounds/divisions/{{$category->slug}}.jpg" class="img-responsive" alt="{{$category->slug}} Image" style="">
      <div class="carousel-control" style="opacity: 1;filter: alpha(opacity=100);padding-left:150px;padding-top:20px">
        {!! $category->welcome_message !!}
      </div>
    </div>
	</a>
	@endforeach

  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
	<div class="col-md-4">
		<h3>COMING SOON</h3>
		<div class="col-md-9 col-md-offset-1" style="overflow-x:hidden">

			<div id="ph-text" class="text-left">

					<div class="col-md-12">

						<!-- <span class="label label-default" >publication Date</span>
						<p>Description, Description, Description, Description.</p> -->
						<h4>SEARCH</h4>
						<hr>
						<h4>GROUPS</h4>
						<hr>
						<h4>TRENDING NEWS</h4>
						<hr>
						<h4>EVENT TRACKING</h4>
						<hr>
						<h4>INTERACTIVE MAP</h4>
						<hr>
					</div>

			</div>

		</div>

	</div>
	<!-- <a id="adjustPage" href="#adjustPage" style="visibility:hidden">_</a> -->
</div>
<!-- <script>
window.onload = function() {
	setTimeout(function(){document.getElementById("adjustPage").click();},35);
}
</script> -->
