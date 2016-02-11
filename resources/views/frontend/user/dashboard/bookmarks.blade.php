@extends('frontend.layouts.master')

@section('content')


    <section style="padding-top:0.75%">
        {{-- <a type="button" class="btn btn-style-alt" href="{{ route('profiles') }}"><span class="fa fa-users"></span> DEMHUB NETWORK</a> --}}
        <div class="row">

            @foreach($items as $index => $item)
                <div class="col-xs-12 col-sm-offset-3 col-sm-6">
                    @include('frontend.card._card')
                </div>
            @endforeach

        </div>
    </section>

@endsection
