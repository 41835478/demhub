@extends('layouts.master')

@section('content')
<div id="user-settings" class="row">
	<div class="col-md-12">
    	<h1>{{Auth::user()->user_name}}'s Files</h1>
        <hr>
    </div>
	<div class="col-md-12 bg-info img-rounded">
		<h4>Upload Files</h4>
		@include('forms.user.file-upload')
		<span>Max: 5mb.</span><br>
		<span>Only PDF's, JPEGs and PNG accepted.</span>
	</div>
	<div class="col-md-12 text-left">
		<table class="table">
			  <thead>
			    <tr>
			      <th>File Type (Image or PDF)</th>
			      <th>File Name</th>
			      <th>Share</th>
			      <th>File Size</th>
			      <th>Last Updated</th>
			      <th>Delete</th>
			      <th>Download</th>
			      
			    </tr>
			  </thead>
			  <tbody>
		@foreach(Auth::user()->files as $file)
			    <tr>
					<td>{{$file->file_extension}}</td>
					<td>
						<a href="{{url('user_files/'.$file->file_name)}}" target="_blank">
							{{$file->file_original_name}}
						</a>
					</td>
					<td>
						<a href="{{url('share', array('id' => $file->id))}}">
							<i class="fa fa-share"></i>
						</a>
					</td>
					<td>{{round($file->file_size/1000000, 2)}} mb</td>
					<td>{{$file->updated_at}}</td>
					<td><i class="fa fa-trash"></i></td>
					<td><i class="fa fa-download"></i></td>
			    </tr>
		@endforeach
			</tbody>
			</table>


	</div>
</div>

@endsection('content')