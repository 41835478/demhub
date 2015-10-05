@extends('layouts.master')

@section('content')
<div id="welcome_home" class="row">
	<div class="col-md-6 col-md-offset-6">
		{!! HTML::image("/images/logo/logo.svg", "Cerial logo", array('class' => 'img-responsive', 'width' => '700')) !!}
	</div>
</div>
<div class="dots">
	<div id="welcome_about" class="row">
		<div class="col-md-12">
			<h1>What is DEMHUB?</h1>
			<p>DEMHUB is a networking platform built to facilitate the exchange of information, experience and resources for the Global Disaster and Emergency Management Industry.</p>
		</div>
		<div class="col-md-2 col-md-offset-1">
			<h3>News Feeds</h3>
			<h2><i class="fa fa-newspaper-o"></i></h2>
			<p>Get the NEWS from reliable industry sources.</p>
	    </div>
	   	<div class="col-md-2">
	   		<h3>Join Discussion</h3>
			<h2><i class="fa fa-comments"></i></h2>
			<p>Start or Join in discussions people should be talking about.</p>
	    </div>
	    <div class="col-md-2">
			<h3>Track Events</h3>
			<h2><i class="fa fa-map-pin"></i></h2>
			<p>Track NEWS and discussions on issues that matter most to you.</p>
	    </div>
	    <div class="col-md-2">
			<h3>Upload and Share</h3>
			<h2><i class="fa fa-files-o"></i></h2>
			<p>Upload documents, reports, articles, and more to share with your network.</p>
	    </div>
	    <div class="col-md-2">
			<h3>Your Custom Page</h3>
			<h2><i class="fa fa-pencil-square-o"></i></h2>
			<p>Customize your page with the resources and info that are specific to you.</p>
	    </div>

	</div>
</div>
<div id="welcome_secondary_text" class="row">
	<div class="col-md-12 text-center">
    	<h2>Connect with your Community</h2>
    </div>
</div>

<div id="welcome_division" class="row">
		@foreach($xmlcategories as $category)

			<a href="{{url('division', array('id' => $category->id))}}">
				<div id="division_{{$category->id}}" style="border-top:7px solid #{{$category->bg_color}};border-bottom:7px solid #{{$category->bg_color}}" class="col-md-2">
					<h5>{{$category->category_name}}</h5>
				</div>
			</a>
		@endforeach

</div>

<div id="welcome_tertiary_text" class="row">
	<div class="col-md-12 text-center">
		<h2>Your place is here</h2>
    </div>
</div>



@endsection('content')
