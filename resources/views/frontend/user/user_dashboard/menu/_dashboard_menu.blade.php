
            <ul class="nav nav-stacked navbar-inverse" id="user-function">


                @if(Request::url() === url('dashboard'))
                <li class="active">
                @else
                <li>
                @endif
                    <a href="{{url('dashboard')}}"><i class="fa fa-user"></i> PROFILE</a>
                </li>
                
                @if(Request::url() === url('connections'))
                <li class="active">
                @else
                <li>
                @endif
                    <a href="{{url('connections') }}"><i class="fa fa-user"></i> CONNECTIONS</a>
                </li>
                @if(Request::url() === url('privacy_settings'))
                <li class="active">
                @else
                <li>
                @endif
                    <a href=""><i class="fa fa-globe" style=""></i> PRIVACY SETTINGS - COMING SOON</a>
                </li>
                @if(Request::url() === url('privacy_settings'))
                <li class="active">
                @else
                <li>
                @endif
                    <a href=""><i class="fa fa-file" style=""></i> COLLECTION - COMING SOON</a>
                </li>
			</ul>
