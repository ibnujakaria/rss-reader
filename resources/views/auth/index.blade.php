@extends('template')

@section('title', 'RSS Reader | Login')

@section('body')
<h2>Login to RSS Reader</h2>
<ul>
	<li>
		<a href="{{route('auth.login', ['provider' => 'facebook'])}}">Login with facebook</a>
	</li>
	<li>
		<a href="{{route('auth.login', ['provider' => 'twitter'])}}">Login with twitter</a>
	</li>
	<li>
		<a href="{{route('auth.login', ['provider' => 'google'])}}">Login with google</a>
	</li>
</ul>
@stop