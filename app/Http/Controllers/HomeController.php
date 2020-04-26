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

    public function images_upload(Request $request){
        if (count($request->images)) {
            foreach ($request->images as $image) {
                $restaurant = RestaurantFoodPhoto::create([
                    'restaurant_basic_info_id' => 'rinzintestin',
                    'path' => $image->store(''),
                    'user_id' => Auth::user()->id,
                ]);
                $image->store('public\Restaurant\Menu-Pictures');
            }
        }
        return $restaurant;

        return response()->json([
            "message" => "Done"
        ]);
    }





    // photo pupload
    public function upload(Request $request){

        // return count($request);
        // return $request;
        // return sizeof($request['data']);
        foreach ($request['data'] as $image) {
            // if ($image) {
                $name = time() . '.'
                    . explode('/', explode(
                        ':',
                        substr(
                            $image,
                            0,
                            strpos($image, ';')
                        )
                    )[1])[1];
                \Image::make($image)->save(public_path('/test_image/') . $name);
                echo $name;
        // }
    }
        // $name = '';
        // for ($i=0; $i < sizeof($request['data']) ; $i++) {
        //     // Image upload script in php
        //     if ($request['data'][$i]) {
        //         $name = time() . '.'
        //             . explode('/', explode(
        //                 ':',
        //                 substr(
        //                     $request['data'][$i],
        //                     0,
        //                     strpos($request['data'][$i], ';')
        //                 )
        //             )[1])[1];
        //         \Image::make($request['data'][$i])->save(public_path('/test_image/') . $name);

        //     }
        //     # code...
        // }
    }
}
