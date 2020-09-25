<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Chellaston Academy</title>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>

      <div id="app">

        <nav class="navbar navbar-dark bg-primary">

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars" style="font-size: 26px;"></i>
          </button>

          <a class="navbar-brand" href="#">Chellaston Academy</a>

          <ul class="navbar-nav ml-auto navbar-icon">
            <li class="nav-item">
              <a href="{{ url('/account') }}" style="color:white;">
                <i class="fas fa-user-circle"></i>
              </a>
            </li>
          </ul>

        </nav>

        <div class="content">
            @yield('content')
        </div>

      </div>

      @yield('javascript')

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    </body>

</html>
