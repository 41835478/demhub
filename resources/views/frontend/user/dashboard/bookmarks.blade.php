@extends('frontend.layouts.master')

@section('content')
    <section id="content_wrapper" class="col-md-10 col-md-offset-1" style="margin-top: 60px;">

        <!-- Begin: Content -->
        <div id="content" class="animated fadeIn" style="padding-bottom: 0px;">
            <div class="row center-block mt10" style="">
                <?php $counter = 0; ?>
                @foreach($publications as $index => $pub)

                    <p style="display:inline;">{{ $pub->name }}</p>
                    @if(Auth::user()->has_bookmarked_publication($pub))
                        {!! Form::model($pub, ['route' => ['unbookmark_publication', $pub->id],
                            'id' => "form-{$pub->id}", 'class' => 'bookmark', 'role' => 'form', 'method' => 'POST']) !!}
                            <button type="submit" class="btn btn-greytone btn-sm" style="height: 30px; width: 120px">
                                <span class="bookmark-tag">
                                    <i class="glyphicon glyphicon-ok"></i> UNBOOKMARK
                                </span>
                                <div class="loader" style="display:none">Loading...</div>
                            </button>
                        {!! Form::close() !!}
                    @else
                        {!! Form::model($pub, ['route' => ['bookmark_publication', $pub->id],
                            'id' => "form-{$pub->id}", 'class' => 'bookmark', 'role' => 'form', 'method' => 'POST']) !!}
                            <button type="submit" class="btn btn-style-alt btn-sm" style="height: 30px; width: 120px">
                                <span class="bookmark-tag">
                                    <i class="glyphicon glyphicon-plus"></i> BOOKMARK
                                </span>
                                <div class="loader" style="display:none">Loading...</div>
                            </button>
                        {!! Form::close() !!}
                    @endif

                @endforeach
            </div>
        </div>

    </section>
@endsection('content')

@section('after-scripts-end')
    {!! HTML::script('js/frontend/card/bookmark.js') !!}
@stop
