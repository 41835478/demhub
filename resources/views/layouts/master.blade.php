<!DOCTYPE html>
<html lang="en">
  @include('layouts._header')
  <body>

    @if (Auth::user())
      <div id="dashboard-icon">
		    <i class="fa fa-angle-double-right" data-toggle="tooltip" data-placement="right" title="Open Dashboard"></i>
	    </div>

      <div id="dashboard">
		    @include('user.menu-user.dashboard-icons')
	    </div>
    @endif

    <div class="container-fluid">

      @include ('guest.menu-user.user')
      @include ('user.menu-user.function')

      @if(Session::has('success'))
        <div class="col-md-6 col-md-offset-6">
          <div id="message" class="alert alert-success alert-dismissible text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
			      {{Session::get('success')}}
          </div>
        </div>
      @endif

      @if(Session::has('error'))
        <div class="col-md-6 col-md-offset-6">
          <div id="message" class="alert alert-danger alert-dismissible text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
      			{{Session::get('error')}}
      		</div>
      	</div>
    	@endif

    	@yield('content')

    </div>

    @include('layouts._footer')
  </body>
</html>
