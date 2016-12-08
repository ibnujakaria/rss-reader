@extends('template')

@section('title', 'RSS Reader | Login')

@section('body')
<div class="fixed-bg">
	<div class="logo">
			<img id="iconrss" src="{{asset('dist//image/logo.png')}}" alt="" />
	</div>
	<div>
		<label id="rss">FEED ME</label>
	</div>

	<div class="card">
		<div class="btnfacebook">
			<a class="btn btn-info btn-custom " href="{{route('auth.login', ['provider' => 'facebook'])}}"><img id="gplus" src="{{asset('dist//image/fb.png')}}" >Login with Facebook</a>
			<a class="btn btn-info btn-custom btntwitter" href="{{route('auth.login', ['provider' => 'twitter'])}}"><img id="gplus" src="{{asset('dist//image/twitter.png')}}" >Login with Twitter</a>
			<a class="btn btn-info btn-custom btngoogle" href="{{route('auth.login', ['provider' => 'google'])}}"><img id="gplus" src="{{asset('dist//image/gplus.png')}}" >Login with Google</a>
		</div>
		<div id="help">
			<a href="https://plus.google.com/+NurulHuda46">need help logging in ?</a>
		</div>
		<div >

		</div>
	</div>
</div>

@stop
