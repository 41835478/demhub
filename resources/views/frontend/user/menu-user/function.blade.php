@if(Auth::check())
    
<nav id="user-function" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{URL::route('home')}}">{{HTML::image("/images/logo/logo.svg", "DEMHUB logo", array('class' => 'img-responsive'))}}
            </a>
                

        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">

                @if(Request::url() === URL::route('home'))
                    <li class="active">
                        <a href="{{URL::route('home')}}">
                            <i class="fa fa-user"></i>
                        </a>
                    </li>
                @else 
                    <li>
                        <a href="{{URL::route('home')}}">
                            <i class="fa fa-user"></i>
                        </a>
                    </li>
                @endif
                @if(Request::url() === URL::route('main-home'))
                    <li class="active">
                        <a href="{{URL::route('main-home')}}">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{URL::route('main-home')}}">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                @endif
                @if(Request::url() === URL::route('discover'))
                <li class="active">
                	<a href="{{URL::route('discover')}}"><i class="fa fa-globe"></i> Discover</a>
                </li>
                @else
                <li>
                    <a href="{{URL::route('discover')}}"><i class="fa fa-globe"></i> Discover</a>
                </li> 
                @endif
                @if(Request::url() === URL::route('discussion'))
                <li class="active">
                    <a href="{{URL::route('discussion')}}"><i class="fa fa-comments"></i> Discussion</a>
                </li>
                @else
                <li>
                    <a href="{{URL::route('discussion')}}"><i class="fa fa-comments"></i> Discussion</a>
                </li> 
                <li>
                    <a>
                        <kbd>Beta</kbd>
                    </a>
                </li>
                @endif


            </ul>
            <ul class="nav navbar-nav navbar-right">
                
                <li style="padding:0;">
                    <a style="padding:5% 0 0 0;">
                        @include('forms.search')
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{Auth::user()->user_name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{URL::route('self_profile')}}">Profile
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{URL::route('logout')}}">Log-Out
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        
        <!--/.nav-collapse -->
    </div>
</nav>
@endif