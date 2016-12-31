<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
	<title>@yield('title')</title>


	<link rel="stylesheet" href="https://cdn.jsdelivr.net/alertifyjs/1.8.0/css/alertify.min.css"/>
	<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.8.0/css/themes/default.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('dist/css/datepicker3.css') }}" rel="stylesheet">
	<link href="{{ asset('dist/css/styles.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('dist/css/custom.css')}}">
	@yield('css')

	<!--Icons-->
	<script src="{{ asset('dist/js/lumino.glyphs.js') }}"></script>
</head>
<body>
	<div id="{{@$app_id}}">
		@include('pieces.navbar')
		@if (auth()->check())
			@if (!@$noSidebar)
				@include('pieces.sidebar')
				<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" style="margin-top: -100px">
					@yield('body')
				</div>
			@else
				<div class="container">
					@yield('body')
				</div>
			@endif
		@else
			@yield('body')
		@endif

		@yield('modal')
	</div>
	<script src="https://unpkg.com/vue/dist/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js"></script>

	<script src="{{ asset('dist/js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('dist/js/bootstrap-datepicker.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/alertifyjs/1.8.0/alertify.min.js"></script>
	<script type="text/javascript">
		$(".modal-fullscreen").on('show.bs.modal', function () {
		  setTimeout( function() {
		    $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
		  }, 0);
		});
		$(".modal-fullscreen").on('hidden.bs.modal', function () {
		  $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
		});
	</script>
	@yield('script')
</body>
</html>
