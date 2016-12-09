@extends('template')

@section('title', 'RSS Reader | Login')

@section('css')
<link rel="stylesheet" href="{{ asset('dist/css/bootstrap-social.css') }}" media="screen" title="no title" charset="utf-8">
<link rel="stylesheet" href="{{ asset('dist/css/font-awesome.css') }}" media="screen" title="no title" charset="utf-8">
@stop

@section('body')
<div class="fixed-bg">
	<div id="logo">
			<img id="iconrss" src="{{asset('dist/image/logo.png')}}" alt="" />
			<div id="textrss">
				<label>Feed Me!</label>
			</div>
	</div>

	<div class="card">
		<a class="btn btn-custom btn-social btn-facebook" href="{{route('auth.login', ['provider' => 'facebook'])}}"><span class="fa fa-facebook"></span>Login with Facebook</a>
		<div id="pemisah"></div>
		<a class="btn btn-custom btn-social btn-twitter" href="{{route('auth.login', ['provider' => 'twitter'])}}"><span class="fa fa-twitter"></span>Login with Twitter</a>
		<div id="pemisah"></div>
		<a class="btn btn-custom btn-social btn-google" href="{{route('auth.login', ['provider' => 'google'])}}"><span class="fa fa-google"></span>Login with Google</a>

		<div id="help">
			<a href="https://plus.google.com/+NurulHuda46">need help logging in ?</a>
		</div>
	</div>
</div>

@stop
