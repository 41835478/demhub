
            <ul class="nav nav-stacked" id="user_dashboard_menu">
                
               
                @if(Request::url() === URL::route('self_profile'))
                <li class="active">
                	<a href="{{URL::route('self_profile')}}" style="background:#60A0FF;color:#FFF;border-color:#000;"><i class="fa fa-user"></i> PROFILE</a>
                </li>
                @else
                <li>
                    <a href="{{URL::route('self_profile')}}"><i class="fa fa-user"></i> PROFILE</a>
                </li>
                @endif
                @if(Request::url() === URL::route('privacy_settings'))
                <li class="active">
                	<a href="{{URL::route('privacy_settings')}}" style="background:#60A0FF;color:#FFF;border-color:#000;"><i class="fa fa-globe"></i> PRIVACY SETTINGS</a>
                </li>
                @else
                <li>
                    <a href="{{URL::route('privacy_settings')}}"><i class="fa fa-globe"></i> PRIVACY SETTINGS</a>
                </li>
                @endif
			</ul>
