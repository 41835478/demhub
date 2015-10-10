@extends('frontend.layouts.master')

@section('content')
<div id="welcome_sign-up" style="padding-top:50px">
<div class="row">
    <div class="col-md-12 text-center">
        <h2 style="font-size:300%">GET THE BETA VERSION</h2>
    </div>
</div>
					

				  <div class="modal fade" id="myModal" style="padding-top:100px">
				    <div class="modal-dialog">
				      <div class="modal-content">
		        
				        <div class="modal-body">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="updateForm()"><span aria-hidden="true">&times;</span></button>
				          <h3>We verify each member who signs up.</h3>
						  <h3>In order to do so DEMHUB needs a few more details.</h3>
						<button type="button" class="btn btn-default btn-style-alt" data-dismiss="modal" onclick="updateForm()">SOUNDS GOOD</button>  
				        </div>
				        <!-- <div class="modal-footer">

				          <button type="button" class="btn btn-primary">Save changes</button>
				        </div> -->
				      </div><!-- /.modal-content -->
				    </div><!-- /.modal-dialog -->
				  </div><!-- /.modal -->
				  <div class="row">
		<div class="col-md-4 col-md-offset-4">
		{!! Form::open(['to' => 'auth/register', 'class' => 'form-horizontal', 'role' => 'form']) !!}
			<div id="form-part-1">
			<div class="form-group">
		    	@if ($errors)
		        	<span>{{$errors->first('Username')}}</span>
		        @endif
		    	<label for="username" class="col-sm-2 control-label" style="font-size:110%">Username</label>
				
		        <div class="col-sm-7 col-sm-offset-1">
		        	<input type="text" name="username" class="form-control" id="username" placeholder="Username"
		         	@if (Input::old('username'))
		            	value = "{{Input::old('username')}}"
		            @endif
		            >
		        </div>
        
		  	</div>
		    <div class="form-group">
		    	@if ($errors)
		        	<span>{{$errors->first('Email')}}</span>
		        @endif
		        <label for="inputEmail3" class="col-sm-2 control-label" style="font-size:110%">Email</label>
				
		        <div class="col-sm-7 col-sm-offset-1">
		        	<input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email"
		            @if (Input::old('email'))
		            	value = "{{Input::old('email')}}"
		            @endif
		            >
		        </div>
		    </div>
		    <div class="form-group">
		    	@if ($errors)
		        	<span>{{$errors->first('Password')}}</span>
		        @endif
		        <label for="inputPassword3" class="col-sm-2 control-label" style="font-size:110%">Password</label>
				
		        <div class="col-sm-7 col-sm-offset-1">
		        	<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
		        </div>
		    </div>
		    <div class="form-group">
		
		        <div class="col-sm-offset-3 col-sm-7">
		              <div class="checkbox">
		                <label>
		                	<input name="remember" type="checkbox"
		                    @if (Input::old('remember'))
		                       checked
		                    @endif
		                    > Remember me
		                </label>
		              </div>
		        </div>
		    </div>
			
		<div style="visibility:hidden">
			{{Form::token()}}
		</div>
		    <div class="form-group">
		        <div class="col-sm-offset-3 col-sm-7">
		        	<button type="button" class="btn btn-default btn-lg btn-style" data-toggle="modal" data-target="#myModal">JOIN</button>
		        </div>
		    </div>
	
		</div>
    
	
			<div id="form-part-2" style="display:none">
		    <div class="form-group">

		        <!-- @if ($errors)
		            <span>{{$errors->first('Username')}}</span>
		        @endif -->
		        <label for="firstName" class="col-sm-3 control-label">First Name</label>
        

		        @if ($errors)
		            <span>{{$errors->first('firstName')}}</span>
		        @endif
        
				
		        <div class="col-sm-7 col-sm-offset-1">

		            <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First Name">
		        </div>
		
		</div>
		    <div class="form-group">

		        <!-- @if ($errors)
		            <span>{{$errors->first('Username')}}</span>
		        @endif -->
		        <label for="lastName" class="col-sm-3 control-label" >Last Name</label>
       

		        @if ($errors)
		            <span>{{$errors->first('lastName')}}</span>
		        @endif
        
				
		        <div class="col-sm-7 col-sm-offset-1">

		            <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name">
		        </div>

   
		</div>
    
		    <div class="form-group">

		        <!-- @if ($errors)
		            <span>{{$errors->first('Username')}}</span>
		        @endif -->
		        <label for="jobtitle" class="col-sm-3 control-label" >Job Title</label>
        

		        @if ($errors)
		            <span>{{$errors->first('jobTitle')}}</span>
		        @endif
        
				
		        <div class="col-sm-7 col-sm-offset-1">

		            <input type="text" name="jobTitle" class="form-control" id="jobTitle" placeholder="Job Title">
		        </div>
   
		</div>
		    <div class="form-group">

		        <!-- @if ($errors)
		            <span>{{$errors->first('Username')}}</span>
		        @endif -->
		        <label for="Organization/Agency" class="col-sm-3 control-label" >Organization</label>
        

		        @if ($errors)
		            <span>{{$errors->first('orgAgency')}}</span>
		        @endif
       
				
		        <div class="col-sm-7 col-sm-offset-1">

		            <input type="text" name="orgAgency" class="form-control" id="orgAgency" placeholder="Organization/Agency">
		        </div>
   
		</div>
		    <div class="form-group">

		        <!-- @if ($errors)
		            <span>{{$errors->first('Username')}}</span>
		        @endif -->
		        <label for="phone" class="col-sm-3 control-label" >Phone Number</label>
        

		        @if ($errors)
		            <span>{{$errors->first('phoneNumber')}}</span>
		        @endif
       
				
		        <div class="col-sm-7 col-sm-offset-1">

		            <input type="text" name="phoneNumber" class="form-control" id="phoneNumber" placeholder="Phone Number">
		        </div>
		
		</div>
		    <div class="form-group">

		        <!-- @if ($errors)
		            <span>{{$errors->first('Username')}}</span>
		        @endif -->
		        <label for="specialization" class="col-sm-3 control-label" >Specialization</label>
        

		        @if ($errors)
		            <span>{{$errors->first('specialization')}}</span>
		        @endif
        
				
		        <div class="col-sm-7 col-sm-offset-1">

		            <select class="form-control" name="specialization" id="specialization">
		                <option>Emergency Management Practitioner</option>
		                <option>Science/Research</option>
		                <option>Academic</option>
		                <option>Health</option>
		                <option>Government</option>
		                <option>CBO/NGO</option>
		                <option>Administrative/Association Management</option>
		                <option>Consultant/Vendor</option>
		                <option>Security/Corporate Health and Safety</option>
		                <option>Student</option>
		                <option>Response</option>
		                <option>Business Continutity</option>
		                <option>Critical Infrustructure </option>
		                <option>Communications</option>
		            </select>
		        </div>
    
		</div>

		    <!-- <div class="form-group">
		        <hr>
		        <div class="col-sm-offset-2 col-sm-7">

		              <div class="checkbox">
		                <label>
		                	<input name="remember" type="checkbox"
		                    @if (Input::old('remember'))
		                       checked
		                    @endif
		                    > Remember me
		                </label>
		              </div>
		        </div>
		    </div> -->
		    <div class="form-group">

		        <div class="col-sm-3">
				</div>
		        <div class="col-sm-offset-4 col-sm-7">

		        	<button type="submit" class="btn btn-default btn-lg btn-style">DONE</button>
		        </div>
		    </div>
		</div>
		{!! Form::close() !!}
	</div>
</div>
</div>
			<script>
			function updateForm(){
				document.getElementById("form-part-1").style.display="none";
				document.getElementById("form-part-2").style.display="";
				// $("#sign-up-form").slideUp();
			}
			</script>	
					

				
@endsection
