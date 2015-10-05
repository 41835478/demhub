@extends('layouts.master')

@section('content')
<div id="user-settings" class="row">
	<div class="col-md-12">
    	<h1>File Share</h1>
        <hr>
    </div>
	<div class="col-md-12 text-center">
		<h3>
			<i class="fa fa-file"></i>
			<a href="{{url('user_files/'.$file->file_name)}}" target="_blank">
				{{$file->file_original_name}}
			</a>
		</h3>
	</div>
	<div class="col-md-8 col-md-offset-2" >
		@include('forms.user.file-share')
	</div>
</div>

@endsection('content')