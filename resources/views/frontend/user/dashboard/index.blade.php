@extends('frontend.layouts.master')

@section('content')

  <div id="main" class="row">
    <!-- id="user-settings" -->
    <div class="dashboard-page sb-l-o sb-r-c onload-check sb-l-m sb-l-disable-animation">

@include('frontend.user.dashboard.menu._dashboard_menu')
  </div>

      <div id="content_wrapper">
      	@include ('frontend.user.dashboard._edit_profile')
  		</div>

  </div>
<!-- <script>
$(document).ready(function(){
  if ($(window).width() < 750) {
    document.getElementById("editProfile").style.marginLeft=0;
    document.getElementById("editProfile").style.paddingLeft=0;
    document.getElementById("avatarSection").style.marginLeft=0;
    document.getElementById("infoSectionMiddle").style.marginLeft=0;
  }
})
$(window).resize(function(){
  if ($(window).width() < 750) {
    document.getElementById("editProfile").style.marginLeft=0;
    document.getElementById("editProfile").style.paddingLeft=0;
    document.getElementById("avatarSection").style.marginLeft=0;
    document.getElementById("infoSectionMiddle").style.marginLeft=0;
  }
})
</script> -->
@endsection('content')
