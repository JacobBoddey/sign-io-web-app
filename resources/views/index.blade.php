@extends('layouts.front_end')

@section('content')

<?php

use App\Http\Controllers\SignController;
use App\Http\Controllers\VerifyController;

$user = Auth::user();

?>

<div class="time-block">

  <span id="time">{{ date("H:i") }}</span>

  <img class="small-logo" width="75px" src="{{ asset('img/logo.png') }}" style="margin-left: 20px;">

</div>

<div class="container" style="margin-top: 20px;">

  <!-- <div class="alert alert-danger">
		You are not currently permitted to sign out
  </div>
  -->

  @if (session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif

  @foreach ($errors->all() as $message)
    <div class="alert alert-danger">
      {{ $message }}
    </div>
  @endforeach

  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <h4>Sign In/Out</h4>

  @if (!$user->isVerified())
    <p>You are not currently verified. In order to sign in or out, you must type the verification code or scan the QR code at reception</p>

    <div class="button bg-primary">Scan QR</div>

    <br>

    <div style="width: 100%; height: 20px; border-bottom: 1px solid #636363; text-align: center">
      <span style="font-size: 16px; background-color: #f8fafc; padding: 0 10px;position:relative;top:5px;">
        OR
      </span>
    </div>

    <br>

    <form method="POST" action="{{ action('VerifyController@verify') }}">
      @csrf
      <input class="form-control" id="code" name="code" type="text" placeholder="5-Digit Code" style="width:40%;display: inline-block;"></input>
      <button type="submit" class="button bg-primary" style="margin-left: 10px;">Verify</button>
    </form>

  @endif

  <p style="margin-top:10px;padding-top:10px;">
    Choose a reason from the dropdown below or enter your own
  </p>

  <form method="POST" action="{{ action('SignController@signIO') }}">

    @csrf

    <div class="dropdown">
      <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" style="width:100%;background-color:#ececec;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Choose a reason
      </a>

      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="#">First reason</a>
        <a class="dropdown-item" href="#">Second reason</a>
        <a class="dropdown-item" href="#">Third reason</a>
      </div>
    </div>

    <div style="width: 100%; height: 20px; border-bottom: 1px solid #636363; text-align: center">
      <span style="font-size: 16px; background-color: #f8fafc; padding: 0 10px;position:relative;top:5px;">
        OR
      </span>
    </div>

    <br>

    <input class="form-control" id="reason" name="reason" type="text" placeholder="Custom reason" style="display: inline-block;"></input>

    <div style="margin-top:15px;margin-bottom:20px;text-align:center;">
      <button class="button bg-primary" style="margin-right: 5px;" type="submit" name="type" value="in">Sign In</button> <button class="button bg-primary" style="margin-left:5px;" type="submit" name="type" value="out">Sign Out</button>
    </div>

  </form>

</div>

@endsection

@section('javascript')

<script>

window.setTimeout(updateTime, 30000);

function updateTime() {
  var d = new Date();
  var h = (d.getHours() < 10 ? '0' : '') + d.getHours();
  var m = (d.getMinutes() < 10 ? '0' : '') + d.getMinutes();
  document.getElementById('time').innerHTML = h + ":" + m;
  setTimeout(updateTime, 30000);
}

</script>

@endsection('javascript')
