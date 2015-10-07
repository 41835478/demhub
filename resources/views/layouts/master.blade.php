<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DEMHUB - Disaster and Emergency Management Network</title>
    @yield('meta')

    <!-- CSS -->
    <link href="{!! elixir('assets/css/core.css') !!}" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="{!! elixir('assets/js/dependencies.js') !!}"></script>
    <script src="{!! elixir('assets/js/core.js') !!}"></script>
  </head>

  <body>
    <div class="wrapper">

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

      <div class="push"></div>
    </div>

    @include('layouts._footer')
  </body>
</html>
