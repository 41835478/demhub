@extends('layouts.master')

@section('content')
<div id="user-settings" class="row">
	<div class="col-md-12">
    	<h1>Resources</h1>
		<hr>
	</div>
</div>
	
    <div class="col-md-6 col-md-offset-3">
		
		<table id="resource-table" class="table table-hover">
			<tbody>
				@foreach($resourceSelects as $entry)
				<tr>
				<td>
    			<a href="{{$entry->entry}}">{{$entry->title}}</a>
				</td>
				</tr>
				@endforeach
			</tbody>
		</table>
    </div>
	

@endsection('content')
