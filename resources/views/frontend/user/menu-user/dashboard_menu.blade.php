
            <ul class="nav nav-stacked" id="user_dashboard_menu">
                
               
                @if(Request::url() === url('self_profile'))
                <li class="active">
                	<a href="{{url('self_profile')}}" style="background:#60A0FF;color:#FFF;border-color:#000;"><i class="fa fa-user"></i> PROFILE</a>
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
                    <a href="{{url('self_profile')}}"><i class="fa fa-globe"></i> PRIVACY SETTINGS - COMING SOON</a>
                </li>
                @if(Request::url() === url('privacy_settings'))
                <li class="active">
                @else
                <li>
                @endif
                    <a href="{{url('self_profile')}}"><i class="fa fa-file"></i> COLLECTION - COMING SOON</a>
                </li>
			</ul>
