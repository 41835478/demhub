<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{$action}}">
	<div class="col-md-3">
  <div class="form-group">
    <label class="col-sm-3 control-label" for="inputuserImage">Avatar</label>
    <div class="col-sm-9">

      <h2>USER IMAGE COMING SOON</h2><br><br>
      <input type="file" name="user_image" id="user_image" placeholder="Browse" value="{{Auth::user()->user_name}}" disabled>
      <br>
      <span class="text-primary">JPEGs and PNG accepted.</span>
      <br>
      <span class="text-danger">Max File size: 2MB</span>
	  <div class="form-group" style="padding-top:50px">
	  	<div class="col-sm-offset-2 col-sm-9">
	      <button type="submit" class="btn btn-default btn-style">SAVE ALL</button>
	    </div>
	  </div> 
	  <p style="visibility:hidden">{{Form::token()}}</p>
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="form-group disabled">
    <label for="firstName" class="col-sm-3 control-label">First Name</label>
    <div class="col-sm-9">
      <input type="text" name="first_name" class="form-control" id="firstName" placeholder="Email" value="{{Auth::user()->first_name}}" disabled>
    </div>
  </div>
  
  <div class="form-group disabled">
    <label for="lastName" class="col-sm-3 control-label">Last Name</label>
    <div class="col-sm-9">
      <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Email" value="{{Auth::user()->last_name}}" disabled>
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputuserName" class="col-sm-3 control-label">Username</label>
    <div class="col-sm-9">
      <input type="text" name="user_name" class="form-control" id="inputuserName" placeholder="Email" value="{{Auth::user()->user_name}}">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputuserName" class="col-sm-3 control-label">Job Title</label>
    <div class="col-sm-9">
      <input type="text" name="job_title" class="form-control" id="inputJobTitle" placeholder="Email" value="{{Auth::user()->job_title}}">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputuserName" class="col-sm-3 control-label">Organization</label>
    <div class="col-sm-9">
      <input type="text" name="org_agency" class="form-control" id="inputOrgAgency" placeholder="Email" value="{{Auth::user()->org_agency}}">
    </div>
  </div>
  
      <div class="form-group">

          <!-- @if ($errors)
              <span>{{$errors->first('Username')}}</span>
          @endif -->
         
          

         
          <label for="specialization" class="col-sm-3 control-label" style="font-size:105%">Specialization</label>
  		<!-- <div class="col-sm-3"></div> -->
          <div class="col-sm-9">

              <select class="form-control" name="specialization" id="specialization">
                  <option class="active">{{Auth::user()->specialization}}</option>
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
</div>
<div class="col-md-3">
  <div class="form-group">
    <label for="inputuserName" class="col-sm-3 control-label">Phone Number</label>
    <div class="col-sm-9">
      <input type="text" name="phone_number" class="form-control" id="inputPhoneNumber" placeholder="phone number" value="{{Auth::user()->phone_number}}">
    </div>
  </div>
    <div class="form-group disabled">
      <label for="inputEmail" class="col-sm-3 control-label">Email</label>
      <div class="col-sm-9">
        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="{{Auth::user()->user_email}}" disabled>
      </div>
   </div>
   
  <div class="form-group">
    <label for="inputLinkedIn" class="col-sm-3 control-label">LinkedIn</label>
    <div class="col-sm-9">
      <input type="text" name="LinkedIn" class="form-control" id="inputLinkedIn" placeholder="ca.linkedin.com/in/..." >
    </div>
  </div>
  
</div>
</form>