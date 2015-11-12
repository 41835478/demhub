<div class="navbar-branding dark">
        <span id="toggle_sidemenu_l" class="ad ad-lines"></span>
</div>
<aside id ="sidebar_left" class="nano nano-light affix sidebar-default">
<div class="sidebar-left-content nano-content">
<ul class="nav sidebar-menu user_dashboard_menu">
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
      <a href="javascript:comingSoonP('my_publications_title)" id="my_publications_title"><i class="fa fa-briefcase"></i> MY PUBLICATIONS</a>
    </li>

    @if(Request::url() === url('connections'))
      <li class="active">
    @else
      <li>
    @endif
      <a href="javascript:comingSoonP('connections_title')" class="text-primary" data-toggle="tooltip" data-placement="top" id="connections_title"><i class="fa fa-users"></i> CONNECTIONS</a>
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
</div>
<div class="nano-pane"><div class="nano-slider" style="height: 595px; transform: translate(0px, 0px);"></div></div>
</aside>
