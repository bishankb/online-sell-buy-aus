<!DOCTYPE HTML>
<html>
<head>
	<title>Error Page</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href='//fonts.googleapis.com/css?family=Fenix' rel='stylesheet' type='text/css'>
   @vite(['resources/css/error.css'])
</head>
<body style="height: 100vh; background: url('{{ asset('error/img/bg2.png') }}') no-repeat center center; background-size: cover;">
  <div class="wrap">

	@yield('content')
	
	<div class="footer">
		<p>&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All Rights Reserved</p>
    </div>
    
  </div>
</body>
</html>