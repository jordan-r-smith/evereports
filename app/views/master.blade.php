<!DOCTYPE html>
<html lang="en">
  <head>
    <title>EVE Reports</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Jordan Smith">

    {{ HTML::style('assets/css/custom.style.css') }}
    {{ HTML::style('assets/css/darkly.min.css') }}
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.ico') }}" />
  </head>
  <body>
    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <nav class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="">
            EVE Reports</a>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
          <ul class="nav navbar-nav">
            {{ HTML::navLink("/", 'Home') }}
            @if(Auth::guest())
            {{ HTML::navLink("register", 'Register') }}
            @elseif(Auth::check())
            {{ HTML::navLink("api", 'Add API') }}
            {{ HTML::navLink("characters", 'Characters') }}
            @endif
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              @if(Auth::guest())
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Log in <b class="caret"></b></a>
              <ul class="dropdown-menu" style="padding: 10px; min-width: 300px; background-color: #375a7f;">
                <li>
                  {{ Form::open(array('action' => 'UsersController@login', 'method' => 'POST', 'id' => 'login', 'class' => 'form-horizontal', 'role' => 'form')) }}
                  <div class="form-group" style="margin: 10px;">
                    <input type="text" placeholder="Username" class="form-control input-sm" name="username" id="username" required />
                  </div>
                  <div class="form-group" style="margin: 10px;">
                    <input type="password" placeholder="Password" class="form-control input-sm" name="password" id="password" required />
                  </div>
                  <div class="form-group" style="margin: 10px;">
                    <input type="checkbox" class="checkbox-inline" name="remember" id="remember" value="remember" />
                    <label for="remember">Keep me logged in</label>
                  </div>
                  <button type="submit" class="btn btn-default btn-sm" style="margin: 5px;" name="logon" id="logon">
                    Sign in
                  </button>
                  {{ Form::close() }}
                </li>
              </ul>
              @elseif(Auth::check())
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                {{ Auth::user() -> username }} <span class="glyphicon glyphicon-user"></span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li>
                  {{ HTML::linkRoute('account', 'Account') }}
                </li>
                <li>
                  {{ HTML::linkRoute('logout', 'Logout') }}
                </li>
              </ul>
              @endif
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="jumbotron">
      <div class="container">
        <header>
          <a href="/">
            <img src="{{ asset('assets/img/banner.jpg') }}" class="img-responsive" alt="EVE Reports" />
          </a>
        </header>
      </div>
    </div>
    <div class="container">
      @if(Session::has('alert-message'))
      <div class="alert alert-dismissable {{ Session::get('alert-class') }}">
        <button type="button" class="close" data-dismiss="alert">
          ×
        </button>
        {{ Session::get('alert-message') }}
      </div>
      @endif
      @yield('content')
      <hr/>
      <footer>
        <p>
          &copy; EVEReports.com 2014
        </p>
      </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/js/form.validate.js') }}"></script>
    <script type="text/javascript">
      $(".alert-dismissable").delay(5000).fadeOut("slow", function() {
        $(this).remove();
      });
    </script>
    @yield('other_includes')
  </body>
</html>