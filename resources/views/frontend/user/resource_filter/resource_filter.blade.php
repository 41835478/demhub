@extends('frontend.layouts.master')

@section('content')
	<div class="row">
		<h3 style="text-align:center">SELECT A LOCATION</h3>
		<div class="col-md-9 col-md-offset-2">
			<span class="hidden-md hidden-lg">Map navigation is currently only accesible on desktop. Mobile map coming soon.</span>
			<button id="backButton" class="btn btn-default btn-style-alt" style="display:none">BACK</button>
			<!-- <button onclick="changeTitle('united_states')">fix it</button> -->
			<div id="map_container" class="visible-md visible-lg">

				<div id="world_map" class="mapContainer">
					<!-- <h1>The World</h1>
					<p>SVG world maps are really helpful for demoing this thing.  (Try the insanely huge <a href="http://commons.wikimedia.org/wiki/Image_talk:BlankMap-World6.svg">SVG world map available on Wikipedia</a>.)</p> -->
					<img class="map" src="./images/maps/demo_world_current.png" width="800" height="400" style="max-width:100%" usemap="#world">
					<map name="world" style="text-transform: capitalize;">
						@include('frontend.user.resource_filter._north_america')
					</map>
				</div>

				<div id="united_states_map" class="mapContainer" style="visibility:hidden;height:1px">
					<!-- <h1>The United States of America</h1>
					<p>This map generated from <a href="http://en.wikipedia.org/wiki/Image:Map_of_USA_with_state_names.svg">"Map of USA with state names.svg"</a>.</p> -->
					<img class="map" id="united_states_img" src="./images/maps/demo_usa.png" width="750" style="max-width:100%;" orgWidth="960" orgHeight="593" usemap="#usa">
					<map name="usa" style="text-transform: capitalize;">
						@include('frontend.user.resource_filter.countries._usa')
					</map>
				</div>

				<div id="canada_map" class="mapContainer" style="visibility:hidden;height:1px;">
					<img class="map" id="canada_img" src="./images/maps/1000px-Canada_labelled_map.png" border="0" width="650" orgWidth="690" orgHeight="669" style="max-width:100%;" usemap="#canada" />
					<map name="canada" style="text-transform: capitalize;">
					<!-- <area shape="rect" coords="998,967,1000,969" alt="Image Map" style="outline:none;" title="Image Map" href="http://www.image-maps.com/index.php?aff=mapped_users_0" /> -->
						@include('frontend.user.resource_filter.countries._canada')
					</map>
				</div>

				<div id="australia_map" class="mapContainer" style="visibility:hidden;height:1px">
					<img class="map" id="australia_img" src="./images/maps/australia_map.png" usemap="#australia" border="0" width="615" orgWidth="690" orgHeight="655" style="max-width:100%;" alt="" />
					<map name="australia" style="text-transform: capitalize;">
						@include('frontend.user.resource_filter.countries._australia')
					</map>
				</div>

			</div>
		</div>
	</div>

	<div id="polyCounters" style="display:none">
		<input id="canada_poly_count" value="13"/>
		<input id="australia_poly_count" value="7"/>
		<input id="united_states_poly_count" value="83"/>
	</div>

	<div id="user-settings" class="row">
		<div class="col-md-12 text-center">

			<br>
			<!-- <h3>Filters</h3> -->
			<!-- <button onclick="changeCoordinates('australia')">Testing
		</button> -->
	<form class="form-inline">
		<div class="form-group" id="countryFormGroup">
				<label for="country">Country</label>
			<select id="country" class="form-control" style="text-transform: capitalize">
				<option value="" disabled selected>Select One</option>
				@foreach ($resourceRelation as $relation)
				{{$country=str_replace("_", " ", $relation->country)}}
				<option>{{$country}}</option>
				@endforeach
			</select>
			</div>
			<div class="form-group" id="regionFormGroup" style="display:none">
					<label for="region">Region</label>
				<select id="region" class="form-control">
					<option value="" disabled selected>Select One</option>
					<option style="display:none"></option>

				</select>
			</div>
			<div class="form-group" id="divisionFormGroup" style="display:none">
					<label for="division">Division</label>
				<select id="division" class="form-control">
					<option value="" disabled selected>Select One</option>
					@foreach ($allDivisions as $division)
					<option value="{{$division->slug}}">{{$division->name}}</option>
					@endforeach
				</select>
			</div>

			</form>
	    <hr>

	  </div>
	</div>

	<script>
		var i=0;
		var element;
		var countries=[];

		@foreach($resourceRelation as $entry)
			countries.push("{{$entry -> country}}");
			element=document.createElement("div");
			element.id="{{$entry -> country}}";
			element.style.display="none";
			element.innerHTML = [{!! $entry -> regions_array !!}];
			document.body.appendChild(element);
			i++;
		@endforeach
	</script>

	<div class="row" id="mapListing" style="display:none">
    <div class="col-sm-5 col-sm-offset-4">
			<table id="resource-table" class="table table-hover">
				<tbody>
					@foreach($resourceEntry as $entry)
						<tr class="collapse in {{$entry ->country}} {{$entry ->region}}">
						<td class="division_tags" style="display:none" value="">
							<?php
			          $divisions = array_filter(preg_split("/\,/", $entry->divisions));
								foreach ($divisions as $division){
									echo $division." ";
								}

			        ?>
							</td>
							<td class="keywords_tags" style="visibility:hidden" value="
								<?php
									$keywords = array_filter(preg_split("/\,/", $entry->keywords));
									foreach ($keywords as $keyword){
										echo $keyword;
									}

				        ?>
								"></td>

							<td>
			    			<a target="_blank" href="{{$entry->url}}" class="text-link-style" style="text-transform: capitalize">{{$entry->name}}</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
    </div>
	</div>
@endsection('content')
