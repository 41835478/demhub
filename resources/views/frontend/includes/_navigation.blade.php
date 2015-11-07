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
