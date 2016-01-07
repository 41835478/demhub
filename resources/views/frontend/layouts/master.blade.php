<!doctype html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', 'The Disaster & Emergency Management Network')">
    <meta name="author" content="@yield('author', 'DEMHUB Developers')">
    <meta property="og:image" content='http://www.demhub.net/images/backgrounds/landing-hero.jpg'>
    <meta name="google-site-verification" content="vVSYl3mhbDJShVxNX9St2jNw1h6sKkHaz1IgTEKC5xs" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    @yield('meta')
    @yield('before-styles-end')
    {!! HTML::style(elixir('css/core.css')) !!}
    {!! HTML::style(elixir('css/frontend.css')) !!}

    @yield('after-styles-end')

    <?php // "coming soon" logic
      $pattern = "/^(http(s?):\/\/)?((((staging)|(beta)).demhub.net)|(localhost:8000)|(demhub.dev))\/?(.+)?$/i";
      $today = date("Y-m-d H:i:s");
      $launch_date = "2015-11-10 00:00:00";
      // FALSE if deploying to production // TRUE if testing on development
      $display_coming_soon = preg_match($pattern, Request::url()) == FALSE && $today < $launch_date;
    ?>

    <!-- @if(Request::url() == url('dashboard') || strpos(Request::url(), "publication")!==false || Request::url()==url('connections'))
      {!! HTML::style(elixir('css/dashboardtest.css')) !!}
    @endif -->

    <!-- Fonts -->
    <link href="//fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css">

    <!-- Icons-->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->



  </head>

  <body class="@yield('body-class')">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


    @if($display_coming_soon)
      @include('frontend.includes._coming-soon')
    @else
      <div class="wrapper">
        @if (Auth::user())
            @include('frontend.includes._feedback_sidebar')
            	@include('modals._feedback_thankyou')
        @endif

        @include('frontend.navigation._navigation')
        @include('includes.partials.messages')
        <div
        @if(Request::url() == url('dashboard') || strpos(Request::url(), "publication")!==false || Request::url()==url('connections'))
        class="@yield('container-class') container-fluid"
        @else
        class="@yield('container-class')"
        @endif
        style="overflow-x:hidden">

          @yield('body-style')
          @yield('content')

        <div class="push"></div>
      </div><!-- ./container-fluid -->
      </div><!-- ./wrapper -->
      @include('frontend.includes._footer')
    @endif

    @yield('modal')

    @include('includes.scripts._google_analytics')
    @include('includes.scripts._hotjar_analytics')

    <script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery-1.11.2.min.js')}}"><\/script>')</script>
    {!! HTML::script('js/vendor/bootstrap.min.js') !!}

    @yield('before-scripts-end')
    {!! HTML::script(elixir('js/frontend.js')) !!}
    @yield('after-scripts-end')

  </body>
</html>
