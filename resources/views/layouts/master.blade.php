<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title></title>
	<!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
    <!-- App Specific CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/directory.css') }}">
  </head>
  <body>
  		@include('layouts.header')

 		@yield('content')
		
		@include('layouts.footer')
		
  </body>
</html>