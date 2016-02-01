@if(Request::url() == url('dashboard'))
    <li class="active">
@else
    <li>
@endif

    <a href="{{url('dashboard')}}">
        <span class="fa fa-user"></span>
        <span class="sidebar-title">PROFILE</span>
    </a>
</li>

@if(strpos(Request::url(), "publication")!==false)
    <li class="active">
@else
    <li>
@endif

    <a href="{{url('my_publications')}}">
        <span class="glyphicon glyphicon-folder-close"></span>
        <span class="sidebar-title" id="my_publications_title">MY PUBLICATIONS</span>
    </a>
</li>

@if(Request::url() == url('connections'))
    <li class="active">
@else
    <li>
@endif

    <a href="{{url('connections')}}">
        <span class="fa fa-users"></span>
        <span class="sidebar-title" id="connections_title">MY NETWORK</span>
    </a>
</li>

<li>
    <a href="javascript:comingSoonP('privacy_settings_title')" style="">
        <span class="fa fa-globe"></span>
        <span class="sidebar-title" id="privacy_settings_title">PRIVACY SETTINGS</span>
    </a>
</li>

<li>
    <a href="javascript:comingSoonP('collection_title')" style="">
        <span class="fa fa-file" style=""></span>
        <span class="sidebar-title" id="collection_title">COLLECTION</span>
    </a>
</li>

@permission('view-backend')
    <li>{!! link_to_route('backend.dashboard', trans('navs.administration')) !!}</li>
@endauth

<li class="divider"></li>
<li>{!! link_to('auth/logout', trans('navs.logout')) !!}</li>
