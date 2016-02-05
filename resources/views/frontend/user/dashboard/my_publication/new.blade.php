@extends('frontend.layouts.master')

@section('content')
    <section id="content_wrapper" class="col-md-10 col-md-offset-1" style="padding-top: 60px;background-color:#fff">

        <!-- Begin: Content -->
        <div id="content" class="animated fadeIn">
            <div class="row center-block mt10">

                <div class="col-sm-10 col-sm-offset-2">
                    <h1>NEW PUBLICATION</h1>

                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::open([
                        'route' => 'store_publication', 'files' => true, 'class' => 'form-horizontal',
                        'method' => 'POST', 'data-toggle'=>'validator', 'data-delay'=>'1100', 'role' => 'form'
                    ]) !!}
                        @include('frontend.user.dashboard.my_publication._form')
                    {!! Form::close() !!}
                </div>

            </div>
        </div> <!-- End: Content -->

    </section>
@endsection
