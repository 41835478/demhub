@if(isset($users))
  @foreach($users as $user)
    @include('frontend.card._card')
  @endforeach
  @else
    @include('frontend.card._card')
@endif
