<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($service)
    {
        $github_user = Socialite::driver($service)->user();
        /**
         * Add User to Database
         *  */ 
        // dd($github_user);
        $user = User::where('provider_id',$github_user->getId())->first();
        if(!$user){
            $user = User::create([
                'email' => $github_user->email,
                'name' => $github_user->name,
                'avatar' => $github_user->avatar,
                'provider_id' => $github_user->id,
            ]);
        }
        // $user->token;
        Auth::login($user,true);
        return redirect($this->redirectTo);
    }
/* login status */
    public function login_status(User $user)
    {
        // return "hellow";
        $isUserLogged = false;
        if (Auth::check()) {
            $isUserLogged = true;
        }
        return response()->json(array('response' => 'success', 'status' => $isUserLogged));
        // return redirect($this->redirectTo);
    }
}
