<!doctype html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', 'Default Description')">
    <meta name="author" content="@yield('author', 'DEMHUB Developers')">


		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> -->

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

    @if($display_coming_soon)
      {!! HTML::style(elixir('css/coming-soon.css')) !!}
    @endif

    <!-- Fonts -->
    <link href="//fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css">

    <!-- Icons-->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    {!! HTML::script("js/vendor/modernizr-2.8.3.min.js") !!}
    {!! HTML::script("js/vendor/jquery.maphilight.min.js") !!}
    
  </head>

  <body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    @if($display_coming_soon)
      @include('frontend.includes._coming-soon')
    @else
      <div class="wrapper">

        @include('frontend.includes._navigation')

        <div class="container-fluid">
          @include('includes.partials.messages')
          @yield('body-style')
          @yield('content')
        </div>

        <div class="push"></div>
      </div><!-- ./wrapper -->

      @include('frontend.includes._footer')
    @endif

    <script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery-1.11.2.min.js')}}"><\/script>')</script>
    {!! HTML::script('js/vendor/bootstrap.min.js') !!}

    @yield('before-scripts-end')
    {!! HTML::script(elixir('js/frontend.js')) !!}
    @yield('after-scripts-end')

    @include('includes.partials.ga')

    <!-- google-analytics -->
    @include('includes.partials._google_analytics')
  </body>
</html>
