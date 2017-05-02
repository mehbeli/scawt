<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        $user = User::find(\Auth::id());
        return view('users.profile')->with(compact('user'));
    }
}
