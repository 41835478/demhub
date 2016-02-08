<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta    charset="utf-8">
        <meta http-equiv="X-UA-Compatible"          content="IE=edge">
        <meta       name="viewport"                 content="width=device-width, initial-scale=1">
        <meta       name="_token"                   content="{{ csrf_token() }}" />
        <meta       name="description"              content="@yield('meta_description', 'The Disaster & Emergency Management Network')">
        <meta       name="author"                   content="@yield('author', 'DEMHUB Developers')">
        <meta       name="google-site-verification" content="vVSYl3mhbDJShVxNX9St2jNw1h6sKkHaz1IgTEKC5xs" />
        <meta   property="og:image"                 content='http://www.demhub.net/images/backgrounds/landing-hero.jpg'>
        @yield('meta')
        
        <title>@yield('title', app_name())</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

        @yield('before-styles-end')
        {!! HTML::style(elixir('css/core.css')) !!}
        {!! HTML::style(elixir('css/frontend.css')) !!}
        @yield('after-styles-end')

        <!-- Fonts -->
        <link href="//fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css">

        <!-- Icons-->
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root public directory -->
    </head>

    <body class="@yield('body-class')">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="wrapper">
            @include('includes.partials.messages')

            <div class="@yield('container-class')" style="overflow-x:hidden;padding-top:25px">
                @yield('body-style')
                @yield('content')
            </div><!-- ./container-fluid -->

            <div class="push"></div>
        </div><!-- ./wrapper -->

        @include('frontend.includes._footer')

        @yield('modal')

        @include('includes.scripts._google_analytics')
        @include('includes.scripts._hotjar_analytics')

        @yield('before-scripts-end')
        {!! HTML::script('js/vendor/bootstrap.min.js') !!}
        {!! HTML::script(elixir('js/frontend.js')) !!}
        @yield('after-scripts-end')
    </body>
</html>
