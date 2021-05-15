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
use MetaTag;

class RestaurantBasicInfoController extends Controller
{
    protected $path = '../public/storage/Restaurant/Banner/';
    protected $path_food = '../public/storage/Restaurant/Food-Pictures/';
    protected $path_menu = '../public/storage/Restaurant/Menu-Pictures/';
    // protected $path = $_SERVER['DOCUMENT_ROOT'].$this->path;

    
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
            // \Image::make($request->banner)->save(public_path($this->path) . $name);
            // return public_path();
            \Image::make($request->banner)->save($this->path. $name);
            // $Original = \Image::make($request->banner)->save(public_path($this->path) . $name);
            $Original = \Image::make($request->banner)->save($this->path. $name);
            // Card 500 X
            $Original->resize(420, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            // \Image::make($Original)->save(public_path($this->path) . $card);
            \Image::make($Original)->save($this->path . $card);
            // Thumbnail 240 X 
            $Original->resize(220, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            // \Image::make($Original)->save(public_path($this->path) . $thumb);
            \Image::make($Original)->save($this->path. $thumb);

        }
        // Store
        $restaurant = RestaurantBasicInfo::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'location' => $request->location,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'email' => $request->email,
            'banner' => $name,
            'card' => $card,
            'rate'=>0,
            'thumb' => $thumb,
            'address' => $request->address,
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
    public function show(RestaurantBasicInfo $restaurantBasicInfo,$id)
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
        $unlink = $this->path . $restaurant->banner;
        $unlink_card = $this->path . $restaurant->card;
        $unlink_thumb = $this->path . $restaurant->thumb;
        unlink($unlink);
        unlink($unlink_card);
        unlink($unlink_thumb);
        // Food Photos
        $food_photos = RestaurantFoodPhoto::where('restaurant_basic_info_id', $id)->get();
        for ($i = 0; $i < $food_photos->count(); $i++) {
            $food_photos[$i]->delete();
            $food_detach = $this->path_food. $food_photos[$i]->path;
            $food_thumb = $this->path_food. $food_photos[$i]->thumb;
            unlink($food_detach);
            unlink($food_thumb);
        }
        // Menu
        $menu_photos = RestaurantMenuPhoto::where('restaurant_basic_info_id', $id)->get();
        for ($i = 0; $i < $menu_photos->count(); $i++) {
            $menu_photos[$i]->delete();
            // path
            $menu_detach = $this->path_menu . $menu_photos[$i]->path;
            $menu_thumb = $this->path_menu . $menu_photos[$i]->thumb;
            // unlink
            unlink($menu_detach);
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
    public function view(RestaurantBasicInfo $restaurantBasicInfo, $id)
    {
        // Meta Description
        $meta = RestaurantBasicInfo::find($id);
        MetaTag::set('title', $meta->name);
        MetaTag::set('description', $meta->location .' '.$meta->description);
        MetaTag::set('image', asset('storage/Restaurant/Banner/'.$meta->banner));
        // Meta Description End
        return view('restaurant.show', ['id' => RestaurantBasicInfo::find($id)]);
    }
    // Display the restaurant Showv
    public function display($id){
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
        // Meta Description
        $meta = RestaurantBasicInfo::find($id);
        MetaTag::set('title', $meta->name);
        MetaTag::set('description', $meta->location .' '.$meta->description);
        MetaTag::set('image', asset('storage/Restaurant/Banner/'.$meta->banner));
        // Meta Description End
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
    public function show_individual(RestaurantBasicInfo $restaurantBasicInfo,$id)
    {
        // return $id;
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
            \Image::make($request->banner)->save($this->path . $name);
            $Original = \Image::make($request->banner)->save($this->path . $name);
            // Card 500 X
            $Original->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save($this->path . $card);
            // Thumbnail 240 X 
            $Original->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save($this->path. $thumb);
        }
        // upate
        $banner = RestaurantBasicInfo::find($id);
        $unlink = $this->path . $banner->banner;
        $unlink_card =  $this->path . $banner->card;
        $unlink_thumb =  $this->path . $banner->thumb;
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
    // Popup ad
    public function popup_ad()
    {
        $restaurants = RestaurantBasicInfo::where('popup_ad', '=', true)
            ->inRandomOrder()
            ->limit('1')
            ->orderBy('created_at', 'desc')->get();
        return $restaurants->toArray($restaurants);
    }
    // Sidebar
    public function sidebar(Request $request,$location){
        $restaurants =  RestaurantBasicInfo::where('location', 'like', "$location%")
        ->where('status', '=', true)
        ->inRandomOrder()
        ->orderBy('created_at', 'desc')->paginate('4');
        return $restaurants->toArray($restaurants);

    }

    // Search View
    public function search_engine(Request $request){
        MetaTag::set('title', $request->location);
        return view('restaurant.search',['location' => $request->location]);
    }
    // Search Query
    public function search(Request $request){

        $restaurants =  RestaurantBasicInfo::where('name', 'like', "$request->name%")
            ->where('location','like',"%$request->location%")
            -> where('rate', 'like', "$request->rate%")
            ->where('status','=','1')
            ->orderBy('created_at', 'desc')->paginate('10');
        return $restaurants->toArray($restaurants);
    }
}
