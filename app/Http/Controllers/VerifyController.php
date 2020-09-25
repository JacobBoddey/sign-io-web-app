<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\VerifyCode;

use App\User;

use Auth;

class VerifyController extends Controller
{

  public function verify(VerifyCode $request) {

    $data = $request->validated();
    $user = Auth::user();

    if (true) {
      $user->last_verified = time();
      $user->save();
      return back()->with('success', 'You are now verified for 2 minutes');
    }
    else {
      return back()->with('error', 'The verification code was incorrect');
    }

  }

}
