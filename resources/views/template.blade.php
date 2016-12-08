<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>

	<link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('dist/css/datepicker3.css') }}" rel="stylesheet">
	<link href="{{ asset('dist/css/styles.css') }}" rel="stylesheet">

	<!--Icons-->
	<script src="{{ asset('dist/js/lumino.glyphs.js') }}"></script>
</head>
<body>
	<div id="{{@$app_id}}">
		@include('pieces.navbar')
		@if (auth()->check())
		@include('pieces.sidebar')
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
			@else
				<div >
					
			@endif
			@yield('body')
		</div>
	</div>
	<script src="https://unpkg.com/vue/dist/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js"></script>

	<script src="{{ asset('dist/js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/chart.min.js') }}"></script>
	<script src="{{ asset('dist/js/chart-data.js') }}"></script>
	<script src="{{ asset('dist/js/easypiechart.js') }}"></script>
	<script src="{{ asset('dist/js/easypiechart-data.js') }}"></script>
	<script src="{{ asset('dist/js/bootstrap-datepicker.js') }}"></script>
	@yield('script')
</body>
</html>
