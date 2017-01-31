<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="A Simple Website">
    <meta name="author" content="Archie Manayaga">
    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title')</title>

    @section('head')
      <!-- Bootstrap core CSS -->
      <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet">

      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <link href="{{ asset('assets/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

      <!-- Custom styles for this template -->
      <link href="{{ asset('assets/css/global.css') }}" rel="stylesheet">
      <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
      <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
      <script src="{{ asset('assets/js/ie-emulation-modes-warning.js') }}"></script>

      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    @show
  </head>

  <body>

    <div class="container-fluid">
      @yield('content')
    </div>

    @section('foot')
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="{{ asset('assets/js/ie10-viewport-bug-workaround.js') }}"></script>
    @show
  </body>
</html>
