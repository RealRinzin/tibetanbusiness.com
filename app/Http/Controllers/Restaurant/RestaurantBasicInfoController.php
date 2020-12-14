<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Restaurant\RestaurantBasicInfoResource;
use App\Http\Resources\Restaurant\RestaurantBasicInfoResourceCollection;
use Illuminate\Support\Facades\DB;
use App\Restaurant\RestaurantBasicInfo;
use App\Restaurant\RestaurantFacility;
use App\Restaurant\RestaurantFoodPhoto;
use App\Restaurant\RestaurantMenuPhoto;
use App\User;
use Illuminate\Support\Facades\Auth;

class RestaurantBasicInfoController extends Controller
{
    protected $path = '../public/storage/Restaurant/Banner/';
    // protected $path = $_SERVER['DOCUMENT_ROOT'].'/storage/Restaurant/Banner/';

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return RestaurantBasicInfoResource::collection(RestaurantBasicInfo::get());
        $restaurants =  RestaurantBasicInfo::all();
        return $restaurants->toArray($restaurants);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $this->path;
        $name = '';
        // Image upload script in php
        if ($request->banner) {
            $name = time() . '.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
            // Card
            $card = time() . '-card.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
            // Thumb
            $thumb = time() . '-thumb.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
            // Original
            // \Image::make($request->banner)->save(public_path('/storage/Restaurant/Banner/') . $name);
            // return public_path();
            \Image::make($request->banner)->save($this->path. $name);
            // $Original = \Image::make($request->banner)->save(public_path('/storage/Restaurant/Banner/') . $name);
            $Original = \Image::make($request->banner)->save($this->path. $name);
            // Card 500 X
            $Original->resize(420, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            // \Image::make($Original)->save(public_path('/storage/Restaurant/Banner/') . $card);
            \Image::make($Original)->save($this->path . $card);
            // Thumbnail 240 X 
            $Original->resize(220, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            // \Image::make($Original)->save(public_path('/storage/Restaurant/Banner/') . $thumb);
            \Image::make($Original)->save($this->path. $thumb);

        }
        // Store
        $restaurant = RestaurantBasicInfo::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'location' => $request->location,
            'email' => $request->email,
            'banner' => $name,
            'card' => $card,
            'rate'=>0,
            'thumb' => $thumb,
            'address' => $request->address,
            'longitude' => '4.5',
            'latitude' => '3.1',
            'status' => true,
            'featured_ad' => false,
            'sidebar_ad' => false,
            'home_ad' => false,
            'description' => $request->description,
            'opening_hour' => $request->opening_hour,
            'closing_hour' => $request->closing_hour,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'website' => $request->website,
        ]);
        return $restaurant;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    public function show($id)
    {
        // return specific user;
        return new RestaurantBasicInfoResource(RestaurantBasicInfo::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return new RestaurantBasicInfoResource(RestaurantBasicInfo::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $restaurantOperationDay = RestaurantBasicInfo::find($id);
        $restaurantOperationDay->update($request->all());
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,RestaurantBasicInfo $restaurantBasicInfo)
    {
        $restaurant = RestaurantBasicInfo::find($id);
        $unlink = public_path() . '/storage/Restaurant/Banner/' . $restaurant->banner;
        $unlink_card = public_path() . '/storage/Restaurant/Banner/' . $restaurant->card;
        $unlink_thumb = public_path() . '/storage/Restaurant/Banner/' . $restaurant->thumb;
        unlink($unlink);
        unlink($unlink_card);
        unlink($unlink_thumb);
        // Food Photos
        $food_photos = RestaurantFoodPhoto::where('restaurant_basic_info_id', $id)->get();
        for ($i = 0; $i < $food_photos->count(); $i++) {
            $food_photos[$i]->delete();
            $food_detach = public_path() . '/storage/Restaurant/Food-Pictures/' . $food_photos[$i]->path;
            $food_card = public_path() . '/storage/Restaurant/Food-Pictures/' . $food_photos[$i]->card;
            $food_thumb = public_path() . '/storage/Restaurant/Food-Pictures/' . $food_photos[$i]->thumb;
            unlink($food_detach);
            unlink($food_card);
            unlink($food_thumb);
        }
        // Menu
        $menu_photos = RestaurantMenuPhoto::where('restaurant_basic_info_id', $id)->get();
        for ($i = 0; $i < $menu_photos->count(); $i++) {
            $menu_photos[$i]->delete();
            // path
            $menu_detach = public_path() . '/storage/Restaurant/Menu-Pictures/' . $menu_photos[$i]->path;
            $menu_card = public_path() . '/storage/Restaurant/Menu-Pictures/' . $menu_photos[$i]->card;
            $menu_thumb = public_path() . '/storage/Restaurant/Menu-Pictures/' . $menu_photos[$i]->thumb;
            // unlink
            unlink($menu_detach);
            unlink($menu_card);
            unlink($menu_thumb);
        }
        // Delete
        $restaurant->delete();
        $restaurant->restaurant_comments()->delete();
        $restaurant->restaurant_facilities()->delete();
        $restaurant->restaurant_food_photos()->delete();
        $restaurant->restaurant_menu_photos()->delete();
        $restaurant->restaurant_operation_days()->delete();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * 
     * View or showing
     * Individual Restaurant
     * without api auth
     * 
     *  */
    public function view($id)
    {
        // return specific user;
        return new RestaurantBasicInfoResource(RestaurantBasicInfo::find($id));
    }
    /**
     *  Restaurant 
     *  Retrieve only the logged / ower's restaurant
     *  */
    public function user_restaurant(User $user,RestaurantBasicInfo $restaurantBasicInfo)
    {
        // Getting only auth resources
        $restaurants = Auth::user()->restaurant_basic_infos;
        return $restaurants->toArray($restaurants);

        // $restaurants =  RestaurantBasicInfo::all();
        // return $restaurants->toArray($restaurants);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restaurant()
    {
        return view('restaurant.show');
    }
    /**
     * 
     * Restaurant Edit
     *  */
    public function restaurant_edit(RestaurantBasicInfo $restaurantBasicInfo, $id)
    {
        if(Auth::user()->id === RestaurantBasicInfo::find($id)->user_id){
            return view('dashboard.restaurant.edit', ['id' => RestaurantBasicInfo::find($id)]);
        }else{
            $this->authorize('restaurant_edit', $restaurantBasicInfo);
            // return redirect('/');
        }
    }

    /**
     * Showing restaurant without relationship
     *  */ 
    public function show_individual($id)
    {
        $restaurant = RestaurantBasicInfo::find($id);
        return $restaurant;
    }
    /**
     *  Updating Star rating
     * Restaurant
     * Star Rate
     * 
     *  */
    public function update_rate(Request $request, $id){
        $rate = RestaurantBasicInfo::find($id);
        $rate->update($request->all());
    }
    /**
     * 
     * Status update 
     * On and off
     * 
     *  */
    public function status_update(Request $request,$id){
        $status = RestaurantBasicInfo::find($id);
        // update
        $status->update($request->all());
    }
    /**
     * Banner update
     * 
     *  */ 
    public function banner_update(Request $request,$id){
        $name = '';
        // Image upload script in php
        if ($request->banner) {
            $name = time() . '.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
            // Card
            $card = time() . '-card.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
            // Thumb
            $thumb = time() . '-thumb.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
            \Image::make($request->banner)->save(public_path('/storage/Restaurant/Banner/') . $name);
            $Original = \Image::make($request->banner)->save(public_path('/storage/Restaurant/Banner/') . $name);
            // Card 500 X
            $Original->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Restaurant/Banner/') . $card);
            // Thumbnail 240 X 
            $Original->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Restaurant/Banner/') . $thumb);
        }
        // upate
        $banner = RestaurantBasicInfo::find($id);
        $unlink = public_path() . '/storage/Restaurant/Banner/' . $banner->banner;
        $unlink_card = public_path() . '/storage/Restaurant/Banner/' . $banner->card;
        $unlink_thumb = public_path() . '/storage/Restaurant/Banner/' . $banner->thumb;
        unlink($unlink);
        unlink($unlink_card);
        unlink($unlink_thumb);
        $banner->update(['banner' => $name,'card'=>$card,'thumb'=>$thumb]);
    }

    /**
     * 
     * Restaurant Advertisment
     * Home Featured
     * Sidebar
     * Banner etc
     *  */
    public function all()
    {
        $restaurants =  RestaurantBasicInfo::where('status', '=', true)
            ->inRandomOrder()
            // ->limit('1')
            ->orderBy('created_at', 'desc')->get();
        return $restaurants->toArray($restaurants);
    }
    
    public function featured_ad(){
        $restaurants =  RestaurantBasicInfo::where('featured_ad', '=', true)
            ->inRandomOrder()
            // ->limit('1')
            ->orderBy('created_at','desc')->get();
        return $restaurants->toArray($restaurants);
        // return RestaurantBasicInfoResource::collection(RestaurantBasicInfo::where('featured_ad', '=', true)->get());
    }
    // Front
    public function home_ad(){
        $restaurants =  RestaurantBasicInfo::where('home_ad', '=', true)
            ->orderBy('created_at', 'desc')
            // ->limit('1')
            ->inRandomOrder()->get();
        return $restaurants->toArray($restaurants);
    }
    // Sidebar
    public function sidebar_ad(){
        $restaurants =  RestaurantBasicInfo::where('sidebar_ad', '=', true)
            ->inRandomOrder()
            // ->limit('1')
            ->orderBy('created_at', 'desc')->get();
        return $restaurants->toArray($restaurants);

    }
    // Sidebar
    public function sidebar(Request $request,$location){
        $restaurants =  RestaurantBasicInfo::where('location', 'like', "$location%")
        ->inRandomOrder()
        ->orderBy('created_at', 'desc')->paginate('4');
        return $restaurants->toArray($restaurants);

    }

    // Search View
    public function search_engine(Request $request){
        return view('restaurant.search',['location' => $request->location]);
    }
    // Search Query
    public function search(Request $request){

        $restaurants =  RestaurantBasicInfo::where('name', 'like', "$request->name%")
            ->where('location','like',"%$request->location%")
            -> where('rate', 'like', "$request->rate%")
            ->where('status','=','1')
            ->orderBy('created_at', 'desc')->paginate('3');
        return $restaurants->toArray($restaurants);
    }
}
