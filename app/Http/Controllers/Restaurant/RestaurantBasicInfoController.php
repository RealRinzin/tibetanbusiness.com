<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Restaurant\RestaurantBasicInfoResource;
use App\Http\Resources\Restaurant\RestaurantBasicInfoResourceCollection;
use Illuminate\Support\Facades\DB;
use App\Restaurant\RestaurantBasicInfo;
use App\Restaurant\RestaurantFacility;
use App\User;
use Illuminate\Support\Facades\Auth;

class RestaurantBasicInfoController extends Controller
{
    
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return "this is create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $restaurant = RestaurantBasicInfo::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'location' => $request->location,
            'email' => $request->email,
            'banner' => 'food5.jpg',
            'rate' => '4.5',
            'address' => $request->address,
            'longitude' => '4.5',
            'latitude' => '3.1',
            'status' => true,
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
    // {
    //     return new RestaurantBasicInfoResource(RestaurantBasicInfo::find($id));
    // }
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
        //
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
        //
        // return $request;
        $restaurantOperationDay = RestaurantBasicInfo::find($id);
        // update
        // return $request;
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
        $restaurant->delete();
        $restaurant->restaurant_comments()->delete();
        $restaurant->restaurant_facilities()->delete();
        $restaurant->restaurant_food_photos()->delete();
        $restaurant->restaurant_menu_photos()->delete();
        $restaurant->restaurant_operation_days()->delete();
        // if(auth()->user()->can('delete', $restaurantBasicInfo)){
        //     $$restaurantBasicInfo->delete();
        // }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return RestaurantBasicInfoResource::collection(RestaurantBasicInfo::all());
        // $restaurants =  RestaurantBasicInfo::all();
        // return $restaurants->toArray($restaurants);
    }
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

        $restaurants =  RestaurantBasicInfo::all();
        return $restaurants->toArray($restaurants);
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
    public function restaurant_edit($id)
    {
        // $this->authorize('view', $restaurantBasicInfo);
        // $this->authorize('restaurant_edit', $restaurantBasicInfo);

        // return new RestaurantBasicInfoResource(RestaurantBasicInfo::find($id));
        return view('dashboard.restaurant.edit', ['id' => RestaurantBasicInfo::find($id)]);

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
     * 
     *  Updating Star rating
     * Restaurant
     * Star Rate
     * 
     *  */
    public function update_rate(Request $request, $id){
        // return $request;
        // return $request;
        $rate = RestaurantBasicInfo::find($id);
        // update
        // return $request;
        $rate->update($request->all());
    }
    /**
     * 
     * Status update 
     * On and off
     * 
     *  */
    public function status_update(Request $request,$id){
        //
        $status = RestaurantBasicInfo::find($id);
        // update
        $status->update($request->all());
    }
}
