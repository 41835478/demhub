@extends('frontend.layouts.master')

@section('content')


	<div class="row">

		<div class="publication-update col-xs-10 col-sm-offset-1">
			<h3> UPDATE </h3>
			@foreach ($allDivisions as $division)

				<a href="{{url('division', $division->slug)}}">
					<div class="Public-landing-box col-md-2">
						<div id="division_{{$division->id}}" style="display:inline;">
							<div class="icon division-{{$division->slug}}">
							</div>
							<div class="publication-update-number"> 6 NEW</div>

							<h3 class="division-landing-name">{{$division->name}}</h3>
						</div>
						<div class= "division-landing-color"style="background-color: #ffffff;"></div>
					</div>
				</a>
			@endforeach
		</div>
		<br></br>
	</div>

	<div class="row">
		<div class="publication-update col-xs-10 col-sm-offset-1">
			<a class="btn btn-default btn-lg btn-style-w" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
	  FILTER
	</a>
	<div class="collapse" id="collapseExample">
	  <div class="well">
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
							<label for="region">State/Prov/Ter</label>
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

					<div class="form-group" id="keywordFormGroup" style="display:none">
							<label for="keyword">Keyword</label>
						<select id="keyword" class="form-control">
							<option value="" disabled selected>Select One</option>
							<option>Planning</option>
							<option>Critical Infrastructure</option>
							<option>Education</option>
							<option>Alerts</option>
							<option>Training</option>
							<option>Cyclone</option>
							<option>Flood</option>
							<option>Tsunami</option>
							<option>Search</option>
							<option>Rescue</option>
							<option>Marine</option>
							<option>Spill</option>
							<option>Storm</option>
							<option>Ocean</option>
							<option>Flood</option>
							<option>Volunteer</option>
							<option>Technology</option>
							<option>Epidemic</option>
							<option>Hazardous Materials</option>
							<option>Air</option>
							<option>Land</option>
							<option>Volcano</option>
							<option>Regulations</option>
							<option>Avalanche</option>
							<option>Chemical</option>
							<option>Biological</option>
							<option>Radiological</option>
							<option>Nuclear</option>
							<option>Explosive</option>
							<option>Bioterrorism</option>
							<option>Pandemic</option>

						</select>
					</div>

					</form>
	  </div>
	</div>

		</div>
	</div>


	<h3 style="text-align:center">SELECT A LOCATION</h3>

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
					<label for="region">State/Prov/Ter</label>
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

			<div class="form-group" id="keywordFormGroup" style="display:none">
					<label for="keyword">Keyword</label>
				<select id="keyword" class="form-control">
					<option value="" disabled selected>Select One</option>
					<option>Planning</option>
					<option>Critical Infrastructure</option>
					<option>Education</option>
					<option>Alerts</option>
					<option>Training</option>
					<option>Cyclone</option>
					<option>Flood</option>
					<option>Tsunami</option>
					<option>Search</option>
					<option>Rescue</option>
					<option>Marine</option>
					<option>Spill</option>
					<option>Storm</option>
					<option>Ocean</option>
					<option>Flood</option>
					<option>Volunteer</option>
					<option>Technology</option>
					<option>Epidemic</option>
					<option>Hazardous Materials</option>
					<option>Air</option>
					<option>Land</option>
					<option>Volcano</option>
					<option>Regulations</option>
					<option>Avalanche</option>
					<option>Chemical</option>
					<option>Biological</option>
					<option>Radiological</option>
					<option>Nuclear</option>
					<option>Explosive</option>
					<option>Bioterrorism</option>
					<option>Pandemic</option>

				</select>
			</div>

			</form>
	    <hr>

	  </div>
	</div>

	<script>
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
							<td class="keyword_tags" style="display:none" value="">
								<?php
									$keywords = array_filter(preg_split("/\,/", $entry->keywords));
									foreach ($keywords as $keyword){
										echo $keyword." ";
									}

				        ?>
								</td>

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
