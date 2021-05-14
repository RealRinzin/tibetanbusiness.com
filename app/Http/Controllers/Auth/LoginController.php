<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Illuminate\Support\Facades\URL;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Redirect;
use MetaTag;
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
        MetaTag::set('title', 'Login - Tibetanbusiness.com');
        MetaTag::set('description','Login Your account with Facebook,Google or Github');
        MetaTag::set('image', asset('/img/home-tibetanbusiness.jpg'));
        $this->middleware('guest')->except('logout');
        // $this->redirectTo = url()->previous();
    }
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($service)
    {
        // $current_url = URL::current();
        return Socialite::driver($service)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($service)
    {

        $current_url = URL::current();
        // return $current_url;

        $socialite_login = Socialite::driver($service)->user();
        /**
         * Add User to Database
         *  */ 
        if($socialite_login->name == null){
            $socialite_login->name = $socialite_login->nickname;
        };
        $user = User::where('provider_id',$socialite_login->getId())->first();
        if(!$user){
            $user = User::create([
                'email' => $socialite_login->email,
                'name' => $socialite_login->name,
                'avatar' => $socialite_login->avatar,
                'provider_id' => $socialite_login->id,
            ]);
        }
        // $user->token;

        Auth::login($user,true);
        // Redirect URL
        /**
         * Social login Redirecting
         * if the user is logged is already in the cache
         * will redirect to the same page
         * otherwise redirect to the home page
         *  */ 
        $url = url()->previous();
        if($url == 'https://google.com' || $url == 'https://www.facebook.com/' || $url == 'https://github.com/'){
            return redirect($this->redirectTo);
        }else{
            return redirect()->back();
        }
        // return redirect($this->redirectTo);
    }
}
