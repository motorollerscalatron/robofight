<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="/">Robot Fight</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      @if (Auth::check())
      <!-- shown only after signed in once -->
      <ul class="nav navbar-nav">
        <li><a href="{{ route('robot.index') }}">My Robots <span class="sr-only">(current)</span></a></li>
        <li><a href="{{ route('robot.fight') }}">Fight!</a></li>
      </ul>
      @endif

      <!-- User -->
      <ul class="nav navbar-nav navbar-right">
        <li>
        <a href="#">
        Hello,
        @if (Auth::check())
        {{ Auth::user()->name }}
        @else
        Guest
        @endif
        </a>
       </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account<span class="caret"></span></a>
          <ul class="dropdown-menu">
      @if (!Auth::check())
            <!-- shown only for guests -->
            <li><a href="{{ route('login') }}">Sign in</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
      @endif

      @if (Auth::check())
            <!-- shown only for logged in users -->         
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form></li>
      @endif
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
