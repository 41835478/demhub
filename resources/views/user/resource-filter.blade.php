@extends('layouts.master')
@extends('structure.main')
@section('content')
<div id="user-settings" class="row">
	<div class="col-md-12 text-center">
    	<h1>Resources</h1>

		<br>
		<!-- <h3>Filters</h3> -->
		<form class="form-inline">
			<div class="form-group">
			    <label for="country">Country</label>
				<select id="country" class="form-control">
					<option value="" disabled selected>Select One</option>
				  <option>Australia</option>
				  <option>Canada</option>
				  <option>United States</option>
				  <option>New Zealand</option>
				</select>
			  </div>
  			<div class="form-group" id="regionFormGroup" style="display:none">
  			    <label for="region">Region</label>
  				<select id="region" class="form-control">
  					<option value="" disabled selected>Select One</option>
  				  <option style="display:none"></option>

  				</select>
  			  </div>
			  <!-- <div class="form-group">
			    <label for="exampleInputEmail2">Email</label>
			    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">
			  </div> -->
			  <!-- <button type="button" onclick="initialFilter()" class="btn btn-default btn-style">FILTER</button>
			  <button type="button" onclick="secondFilter()" class="btn btn-default btn-style">FILTER 2</button>  -->
		</form>
        <hr>
    </div>

</div>
	<style>
		div.paginated ul.pagination li span{
			color: #000;
		}
		div.paginated ul.pagination li.active span {
			background: #000;
			border: 1px solid #ccc;
			color:#FFF;
		}
		div.paginated ul.pagination li a {
			color: #ccc;
		}

	</style>

	<script>
	var i=0;
	var element;
	var countries=[];
		@foreach($resourceRelation as $entry)
			countries.push("{{$entry -> country}}");
			element=document.createElement("div");
			element.id="{{$entry -> country}}";
			element.style.display="none";
			element.innerHTML = [{{$entry -> regions}}];
			document.body.appendChild(element);
			i++;
		@endforeach


	</script>
	<div class="row">
    <div class="col-sm-5 col-sm-offset-4">

		<table id="resource-table" class="table table-hover">
			<tbody>
				@foreach($resourceEntry as $entry)
				<tr class="collapse in {{$entry ->country}} {{$entry ->region}}">
				<td>
    			<a href="{{$entry->entry}}">{{$entry->title}}</a>
				</td>
				</tr>
				@endforeach
			</tbody>
		</table>
    </div>
	<div class="col-sm-5 col-sm-offset-4 paginated" >

	</div>
</div>

	<script>
	$("select#country").click(function(){
	if (($("select#country").val()) != null){

		var filterVar = $("select#country").val();
		var country = filterVar.toLowerCase();
		country=country.replace(/ /g,"_");

		// var list =document.getElementsByClassName(country);

		if($("tr").hasClass('in')) {
		        $("tr").addClass("out");
		        $("tr").removeClass("in");
		        $("tr." +country).addClass("in");
		        $("tr." +country).removeClass("out");
		    }
			fillRegions(country);
			var regionForm =("<option value='' disabled selected>Select One</option>; "+fillRegions(country));
			document.getElementById("region").innerHTML=regionForm;
			document.getElementById("regionFormGroup").style.display="";
		}
	});
	function fillRegions(country){
		var data = document.getElementById(country).innerHTML;
		// data=data.replace(/,/g,'","');
		var regionArray= data.split(",");
		var optionHTML="";
		for (var i=0;i<(regionArray.length);i++){
			optionHTML += ("<option>"+regionArray[i]+"</option>; ");
		};
		// console.log(optionHTML);
		return optionHTML;
	}
	$("select#region").click(function(){
	if (($("select#region").val()) != null){
		var filterVar = $("select#region").val();
		var region = filterVar.toLowerCase();
		region=region.replace(/-/g,"_");

		// var list =document.getElementsByClassName(country);

		if($("tr").hasClass('in')) {
		        $("tr").addClass("out");
		        $("tr").removeClass("in");
		        $("tr." +region).addClass("in");
		        $("tr." +region).removeClass("out");
		    }
	}
	});
	</script>
@endsection('content')
