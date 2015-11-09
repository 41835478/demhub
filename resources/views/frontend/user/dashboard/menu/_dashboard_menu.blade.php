<ul class="nav nav-stacked navbar-inverse user_dashboard_menu">

    @if(Request::url() == url('dashboard'))
      <li class="active">
    @else
      <li>
    @endif
      <a href="{{url('dashboard')}}"><i class="fa fa-user"></i> PROFILE</a>
    </li>

    @if(Request::url() === url('publications'))
      <li class="active">
    @else
      <li>
    @endif
      <a href="{{url('publications')}}"><i class="fa fa-briefcase"></i> MY PUBLICATIONS</a>
    </li>

    @if(Request::url() === url('connections'))
      <li class="active">
    @else
      <li>
    @endif
      <a href="javascript:comingSoonP('connections_title')" id="connections_title"><i class="fa fa-users"></i> CONNECTIONS</a>
    </li>

    @if(Request::url() === url('privacy_settings'))
      <li class="active">
    @else
      <li>
    @endif
      <a href="javascript:comingSoonP('privacy_settings_title')" id="privacy_settings_title" style=""><i class="fa fa-globe" style=""></i> PRIVACY SETTINGS</a>
    </li>

    @if(Request::url() === url('privacy_settings'))
      <li class="active">
    @else
      <li>
    @endif
      <a href="javascript:comingSoonP('collection_title')" id="collection_title" style=""><i class="fa fa-file" style=""></i> COLLECTION</a>
    </li>

</ul>
