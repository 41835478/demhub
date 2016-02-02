@extends('frontend.layouts.master')

@section('content')
  <section id="content_wrapper" class="col-md-10 col-md-offset-1" style="margin-top: 60px;">

    <!-- Begin: Content -->
    <div id="content" class="animated fadeIn" style="padding-bottom: 0px;">
      <a type="button" class="btn btn-style-alt" href="{{ route('profiles') }}"><span class="fa fa-users"></span> DEMHUB NETWORK</a>

      <div class="row center-block mt10" style="">
        <?php $counter=0; ?>
          @foreach($users as $key => $user)
            @if(Auth::user()->is_following($user))
              <?php $counter++; ?>
            @elseif($key = sizeof($users) && $counter = 0)
              <?php $counter++; ?>
              <div class="col-xs-12 col-sm-6 col-md-4">
                <h4 style="">You Haven't Followed Anyone yet. </h4>
                <a type="button" class="btn btn-style-alt btn-sm" href="{{url('profiles')}}">
                  <span class="fa fa-users" aria-hidden="true"> FIND OTHERS ON THE DEMHUB NETWORK</span>
                </a>
              </div>
            @endif
          @endforeach
          <!-- </div> -->
        </div>
      </div>
    </section>
  @foreach($users as $index => $item)
    @include('frontend.card._card')
  @endforeach
@endsection('content')
