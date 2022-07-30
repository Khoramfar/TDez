<!DOCTYPE html>
<html lang="en" dir="rtl">
	<head>
	  <title> تیکدز | @yield('title') </title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link href="/css/bootstrap.min.css" rel="stylesheet">
      <link href="/css/font.css" rel="stylesheet">
      <link href="/css/additional.css" rel="stylesheet">
      <link href="/css/all.css" rel="stylesheet">
      <link rel="icon" href="/img/ico/favicon.ico" />
	  <script src="/js/bootstrap.min.js"></script>
      <script src="/js/jquery.min.js"></script>
	</head>

	<body>
		@include('/layouts/header')
        @yield('insidetop')
		<div class="container-fluid">
			@yield('insidecont')
		</div>
        @include('/layouts/footer')
	</body>
</html>


