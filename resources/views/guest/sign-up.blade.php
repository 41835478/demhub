@extends('layouts.master')

@section('content')

<div id="welcome_sign-up" class="row">
    <div class="col-md-12 text-center">
        <h2 style="font-size:300%">GET THE BETA VERSION</h2>
    </div>
    <div class="col-md-4 col-md-offset-4">
        @include('forms.sign-up')
    </div>
</div>
@if (count($errors) > 1)
    <script>
        $(document).ready(function(e){
            var scrl = $("div#welcome_sign-up").position().top;
            $("body, html").animate({
                scrollTop: scrl+"px"
            });
        });
    </script>
@endif

@endsection('content')