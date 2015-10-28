<nav id="user-function" class="navbar navbar-inverse navbar-fixed-top" style="padding-left:30px">
	<div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	    <span class="sr-only">Toggle navigation</span>

	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
    </button>
		<a href="{{url('userhome')}}">{!! HTML::image("/images/logo/logo-min-white.png", "DEMHUB logo", array('class' => 'img-responsive','style' => 'width:175px;padding-left:30px;padding-top:10px')) !!}
		</a>
	</div>

	<div class="container">
	<div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a>
                        <kbd>BETA</kbd>
                    </a>
                </li>
                <!-- @if(Request::url() === url('home'))
                    <li class="active">
                        <a href="{{url('userhome')}}">
                            <i class="fa fa-user"> PROFILE</i>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{url('home')}}">
                            <i class="fa fa-user"></i> PROFILE</a>
                    </li>
                @endif
                @if(Request::url() === url('discover'))
                <li class="active">
                	<a href="{{url('discover')}}"><i class="fa fa-globe"></i> DISCOVER</a>
                </li>
                @else
                <li>
                    <a href="{{url('discover')}}"><i class="fa fa-globe"></i> DISCOVER</a>
                </li>
                @endif
                @if(Request::url() === url('discussion'))
                <li class="active">
                    <a href="{{url('discussion')}}"><i class="fa fa-comments"></i> DISCUSSION</a>
                </li>
                @else
                <li>
                    <a href="{{url('discussion')}}"><i class="fa fa-comments"></i> DISCUSSION</a>
                </li>


                @endif -->


            </ul>
            <ul class="nav navbar-nav navbar-right" style="padding-right:25px">

                <li style="padding:0;">
                    <a style="padding:5% 0 0 0;">
                        <!-- @include('forms.search') -->
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="text-transform: uppercase">{{Auth::user()->user_name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu navbar-inverse" role="menu">
                        <li>
                            <a href="{{url('self_profile')}}">USER DASHBOARD
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            {!! link_to('auth/logout', trans('LOGOUT')) !!}
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!--/.nav-collapse -->
    </div>
	</div>
</nav>
