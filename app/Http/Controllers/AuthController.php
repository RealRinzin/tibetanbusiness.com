<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    //
    /* login status */
    public function login_status()
    {
        // return "hellow";
        $user = '';
        $isUserLogged = false;
        if (Auth::check()) {
            $user = Auth::user();
            $isUserLogged = true;
        }
        return response()->json(array('response' => 'success', 'status' => $isUserLogged, 'user' => $user));
        // return redirect($this->redirectTo);
    }
}
