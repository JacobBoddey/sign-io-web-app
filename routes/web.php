<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SignController;
use App\Http\Controllers\VerifyController;

Route::get('/', function() {
  if (Auth::check()) {
    return view('index');
  }
  else {
    return view('public');
  }
});

Route::post('verify', 'VerifyController@verify');

Route::post('signio', 'SignController@signIO');

Route::group(['prefix' => 'account', 'middleware' => 'auth'], function() {

  Route::get('/', function() {
    return view('account.index');
  });

});

Route::get('login', 'AuthController@login')->name('login');

Route::get('auth/callback', 'AuthController@callback');

Route::get('/logout', 'AuthController@logout');

Route::get('/home', 'HomeController@index')->name('home');
