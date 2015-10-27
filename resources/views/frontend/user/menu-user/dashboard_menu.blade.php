
            <ul class="nav nav-stacked navbar-inverse" id="user-function">


                @if(Request::url() === url('self_profile'))
                <li class="active">
                	<a href="{{url('self_profile')}}"><i class="fa fa-user"></i> PROFILE</a>
                </li>
                @else
                <li>
                    <a href="{{url('self_profile')}}"><i class="fa fa-user"></i> PROFILE</a>
                </li>
                @endif
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
