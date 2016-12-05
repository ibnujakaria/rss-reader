<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
</head>
<body>
	<header>
		<h1>RSS Reader</h1>
	</header>
	<nav>
		Menu
		<ul>
			<li><a href="{{url('/')}}">Home</a></li>
			<li><a href="">About</a></li>
		</ul>
	</nav>
	<div>
		@yield('body')
	</div>
</body>
</html>