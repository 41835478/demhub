@include('frontend.navigation._navbar')

@if (Auth::user() && !empty($allDivisions))
  @if (!isset($userMenu))
    @if (Request::url() == url('thefuture'))
      @include ('frontend.navigation._carousel-menu-user')
    @endif
  @endif
  @include ('frontend.navigation._second-menu-user')
@endif
@if( isset($navDivisions) && !isset($userMenu))
  @include('frontend.navigation._nav_divisions')
@endif
@if(Auth::guest() && ! empty($allDivisions))
  @include('frontend.navigation._second-menu-user-registration-required')
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
    document.getElementById(elementId).style.fontSize='90%';
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
    document.getElementById(elementId).style.fontSize='80%';
    comingSoonElementNames.push(elementId);
  }
}
function comingSoonTextP(){
  var text;
  text="<span style='color:#98a9c1'> - COMING SOON </span>";
  return text;
}

</script>
