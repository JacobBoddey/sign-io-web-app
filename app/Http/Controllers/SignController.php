<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SignIO;

use App\User;

use Auth;
use DB;

class SignController extends Controller
{

  public function signIO(SignIO $request) {

    $data = $request->validated();
    $user = Auth::user();

    if ($request->input('type') == "in") {
      $this->insert($user->id, 1, $request->input('reason'));
      return back()->with('success', "You have successfully signed in");
    }
    else if ($request->input('type') == "out") {
      $this->insert($user->id, 0, $request->input('reason'));
      return back()->with('success', "You have successfully signed out");
    }
    else {
      return back()->with('error', "There was an error whilst trying to sign in or out");
    }

  }

  public function insert($id, $type, $reason) {

    DB::table('activity')->insert(
      [
        'user_id' => $id,
        'timestamp' => time(),
        'type' => $type,
        'reason' => $reason
      ]
    );

  }

}
