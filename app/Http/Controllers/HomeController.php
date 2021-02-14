<?php

namespace App\Http\Controllers;

use App\Restaurant\RestaurantFoodPhoto;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * 
     * Login Status
     * Check if logged or not
     *  */
    public function login_status()
    {
        // return "hellow";
        $isUserLogged = false;
        if (Auth::check()) {
            $user = Auth::user();
            $isUserLogged = true;
        }else{
            $user = "";
        }
        return response()->json(array('response' => 'success', 'status' =>$isUserLogged,'user' => $user));
        // return redirect($this->redirectTo);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
