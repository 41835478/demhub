@extends('structure.main')

@section('content')
<div class="row">
	<div class="col-md-12">
    	<h3>{{$userapp->app_name}}</h3>
        <hr>
    </div>
</div>
@if ($userapp)

        	<div class="col-md-4">
            	<h3>Details</h3>
            </div>
        	<div class="col-md-8">
                	<h3>{{$userapp->app_name}}</h3>
                    <p>
                    	{{$userapp->app_desc}}
                    </p> 
                    @if ($userapp->app_public)
	                    <kbd>{{secure_url('app/'.$userapp->user_name.'/'.$userapp->app_url, $parameters = array())}}</kbd>
                   	@endif  
                   <hr />            
                
            </div>
            
            <div class="col-md-4">
            	<h3>Settings</h3>
            </div>
        	<div class="col-md-8">
            	<h6>Board</h6>
            	<p>
                {{$userapp->board_name}}
                </p>    	
			<hr />
            </div>
            
            <div class="col-md-4">
            	<h3>Sample Code</h3>
            </div>
        	<div class="col-md-8">
                	<h3>Sample Code</h3>
                    <samp>
                    	{{$userapp->app_code}}
                    </samp>     
                    <hr />       
                
            </div>
           
            
            <div class="col-md-4">
            	<h3>Keys and Access Tokens</h3>
            </div>
        	<div class="col-md-8">
                	<h5>App's API Key</h5>
                    <code>{{$userapp->app_key}}</code>
                    
                    
                    <hr />
                
            </div>
            
            
           
          
@endif

@endsection('content')
