@include('frontend.includes._navbar')
@if( isset($navDivisions) )
  @include('frontend.includes._nav_divisions')
@endif
@if (Auth::user() && ! empty($allDivisions))
  @if (!isset($userMenu))
    @if (Request::url() == url('userhome'))
      @include ('frontend.user.menu-user._carousel-menu-user')
    @endif
    @include ('frontend.user.menu-user._second-menu-user')
  @endif
@endif
