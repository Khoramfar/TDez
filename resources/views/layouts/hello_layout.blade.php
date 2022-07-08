<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>@yield('onvan')</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link href="/css/bootstrap.min.css" rel="stylesheet">
	  <script src="/js/bootstrap.min.js"></script>
	</head>
	
	<body style="height:1500px">

		@include('my_navbar')
		<div class="container-fluid"><br>
			@yield('mohtava')
		</div>

	</body>
</html>



