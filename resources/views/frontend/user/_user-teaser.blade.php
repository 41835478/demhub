@if(isset($users))
  @foreach($users as $user)
    @include('frontend.user.__user-teaser')
  @endforeach
  @else
    @include('frontend.user.__user-teaser')
@endif
