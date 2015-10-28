@include('frontend.includes._navbar')
@if( !empty($nav_divisions) )
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
