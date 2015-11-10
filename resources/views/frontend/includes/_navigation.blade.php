@include('frontend.includes._navbar')

@if (Auth::user() && ! empty($allDivisions))
  @if (!isset($userMenu))
    @if (Request::url() == url('thefuture'))
      @include ('frontend.user.menu-user._carousel-menu-user')
    @endif
    @include ('frontend.user.menu-user._second-menu-user')
  @endif
@endif
@if( isset($navDivisions) && !isset($userMenu))
  @include('frontend.includes._nav_divisions')
@endif

<script>
var comingSoonElementNames=[];
function comingSoon (elementId) {
  var alreadyAdded=false;
  for (var i=0;i<comingSoonElementNames.length;i++){
    if (elementId==comingSoonElementNames[i]){
      alreadyAdded=true;
    }
  }
  if (alreadyAdded==false){
    document.getElementById(elementId).innerHTML=document.getElementById(elementId).innerHTML+comingSoonText();
    document.getElementById(elementId).style.paddingRight='5px';
    document.getElementById(elementId).style.paddingLeft='5px';
    comingSoonElementNames.push(elementId);
  }
}

function comingSoonText(){
  var text;
  text="<span style='color:#98a9c1;'> - COMING SOON </span>";
  return text;
}
function comingSoonP (elementId) {
  var alreadyAdded=false;
  for (var i=0;i<comingSoonElementNames.length;i++){
    if (elementId==comingSoonElementNames[i]){
      alreadyAdded=true;
    }
  }
  if (alreadyAdded==false){
    document.getElementById(elementId).innerHTML=document.getElementById(elementId).innerHTML+comingSoonTextP();
    document.getElementById(elementId).style.paddingRight='5px';
    document.getElementById(elementId).style.paddingLeft='5px';
    comingSoonElementNames.push(elementId);
  }
}
function comingSoonTextP(){
  var text;
  text="<p style='color:#98a9c1;text-align:center'> - COMING SOON </p>";
  return text;
}

</script>
