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

    <body class="bg-primary">

      <div id="app">

        <div class="container" style="padding-top:100px;padding-bottom:100px;">

          <center>

            <img src="{{ asset('img/logo.png') }}">

            <h4 style="color:white;">Chellaston Academy</h4>

            <a href="{{ url('/login') }}">
              <button class="btn" style="border-radius:0;margin-top:30px;background-color:white;padding:5px 10px 5px 10px;"><img width="15px" style="margin-right:5px;" src="{{asset('img/microsoft_logo.png') }}"> Login using your Microsoft account</button>
            </a>

          </center>

        </div>

      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    </body>

</html>
