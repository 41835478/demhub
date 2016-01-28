@extends('frontend.layouts.master')

@section('content')
  {{-- @include('frontend.user.dashboard.style')
  @include('frontend.navigation._user-dashboard-sidebar') --}}
  <section id="content_wrapper" class="col-md-10 col-md-offset-1" style="margin-top: 60px;">

    <!-- Begin: Content -->
    <div id="content" class="animated fadeIn" style="padding-bottom: 0px;">

      <div class="row center-block mt10" style="">
        <?php $counter=0; ?>
        @foreach($publications as $index => $pub)
          <p style="display:inline;">{{ $pub->name }}</p>
          @if(Auth::user()->has_bookmarked_publication($pub))
            {!! Form::model($pub, ['route' => ['unbookmark_publication', $pub->id], 'style' => '', 'role' => 'form', 'method' => 'POST']) !!}
              {!! Form::token() !!}
              <button type="submit" class="btn btn-greytone btn-sm" style="">
                <i class="glyphicon glyphicon-ok"></i><span style="font-size:85%"> UNBOOKMARK</span>
              </button>
          @else
            {!! Form::model($pub, ['route' => ['bookmark_publication', $pub->id], 'style' => '', 'role' => 'form', 'method' => 'POST']) !!}
              {!! Form::token() !!}
              <button type="submit" class="btn btn-style-alt btn-sm" style="">
                <i class="glyphicon glyphicon-plus"></i> BOOKMARK
              </button>
          @endif
          {!! Form::close() !!}

        @endforeach
          <!-- </div> -->
      </div>

      <hr>

      <div class="row center-block mt10" style="">
        <?php $counter=0; ?>
        @foreach($publications as $index => $pub)
          <p style="display:inline;">{{ $pub->name }}</p>
          @if(Auth::user()->has_bookmarked_publication($pub))
            {!! Form::model($pub, ['route' => ['unbookmark_publication', $pub->id], 'style' => '', 'role' => 'form', 'method' => 'POST']) !!}
              {!! Form::token() !!}
              <button type="submit" class="btn btn-greytone btn-sm" style="">
                <i class="glyphicon glyphicon-ok"></i><span style="font-size:85%"> UNBOOKMARK</span>
              </button>
          @else
            {!! Form::model($pub, ['route' => ['bookmark_publication', $pub->id], 'style' => '', 'role' => 'form', 'method' => 'POST']) !!}
              {!! Form::token() !!}
              <button type="submit" class="btn btn-style-alt btn-sm" style="">
                <i class="glyphicon glyphicon-plus"></i> BOOKMARK
              </button>
          @endif
          {!! Form::close() !!}

        @endforeach
          <!-- </div> -->
      </div>

    </div>

  </section>

  {{-- @include('frontend.user.__user-card-partial') --}}
@endsection('content')
