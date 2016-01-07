
<!-- Start: Sidebar -->
<aside id="sidebar_left" class="nano nano-light affix">

  <!-- Start: Sidebar Left Content -->
  <div class="sidebar-left-content nano-content">

    <!-- Start: Sidebar Menu -->
    <ul class="nav sidebar-menu">
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
          <span class="sidebar-title" id="connections_title">CONNECTIONS</span>
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
    </ul>
    <!-- End: Sidebar Menu -->

    <!-- Start: Sidebar Collapse Button -->
    <div class="sidebar-toggle-mini">
      <a href="#">
        <span class="fa fa-sign-out"></span>
      </a>
    </div>
    <!-- End: Sidebar Collapse Button -->

  </div>
  <!-- End: Sidebar Left Content -->

</aside>
<!-- End: Sidebar Left -->

<style media="screen">
  body.sb-l-m #sidebar_left.nano{
    /*height: calc(100% + 60px) !important;*/
  }
</style>
