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
			@if (auth()->check())
			<li>
				{{auth()->user()->name}}
				<ul>
					<li><a href="">Setting</a></li>
					<li><a href="{{route('auth.logout')}}">Logout</a></li>
				</ul>
			</li>
			@else
			<li><a href="{{route('auth.index')}}">Login</a></li>
			@endif
		</ul>
	</nav>
	<div>
		@yield('body')
	</div>
</body>
</html>