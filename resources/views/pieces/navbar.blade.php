<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:#34495E;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{url('/')}}"><span>RSS</span>Reader</a>
      <ul class="user-menu">
        @if (auth()->check())
        <li class="dropdown pull-right">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> {{auth()->user()->name}} <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
            <li><a href="{{route('auth.logout')}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
          </ul>
        </li>
        @else
  			<li><a href="{{route('auth.index')}}">Login</a></li>
  			@endif
      </ul>
    </div>

  </div><!-- /.container-fluid -->
</nav>
