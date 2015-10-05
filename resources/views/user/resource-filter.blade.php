@extends('layouts.master')

@section('content')
<div id="user-settings" class="row">
	<div class="col-md-12">
    	<h1>Resources</h1>
		<h3>Filters</h3>
		<form class="form-inline">
			<div class="form-group">
			    <label for="country">Country</label>
				<select id="country" class="form-control">
				  <option>Australia</option>
				  <option>Canada</option>
				  <option>United States</option>
				  <option>New Zealand</option>
				</select>
			  </div>
			  <!-- <div class="form-group">
			    <label for="exampleInputEmail2">Email</label>
			    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">
			  </div> -->
			  <button type="button" onclick="filterFunction()" class="btn btn-default btn-style">FILTER</button>
		</form>
        <hr>
    </div>
</div>
	
	<div class="row">
    <div class="col-md-6 col-md-offset-3">
		
		<table id="resource-table" class="table table-hover">
			<tbody>
				@foreach($resourceEntry as $entry)
				<tr class="collapse in {{$entry ->country}}">
				<td>
    			<a href="{{$entry->entry}}">{{$entry->title}}</a>
				</td>
				</tr>
				@endforeach
			</tbody>
		</table>
    </div>
</div>
	<script>
	function filterFunction(){
		var filterVar = $("select#country").val();
		var country = filterVar.toLowerCase();
		country=country.replace(/ /g,"-");
		
		// var list =document.getElementsByClassName(country);
		
		if($("tr").hasClass('in')) {
		        $("tr").addClass("out");
		        $("tr").removeClass("in");
		        $("tr." +country).addClass("in");
		        $("tr." +country).removeClass("out");
		    } 


	}
	</script>
@endsection('content')
