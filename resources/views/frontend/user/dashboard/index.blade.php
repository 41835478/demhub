@extends('frontend.layouts.master')

@section('content')

  <div id="user-settings" class="row">
    <div class="col-md-12" style="padding:0px">
  		<div class="col-md-3" style="padding:0px">
  			@include('frontend.user.dashboard.menu._dashboard_menu')

  		</div>

      <div id="editProfile" class="col-md-9 col-xs-offset-5" style="padding:0px;margin-left:-5%">
      	@include ('frontend.user.dashboard._edit_profile')
  		</div>
    </div>
  </div>
<script>
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
</script>
@endsection('content')
