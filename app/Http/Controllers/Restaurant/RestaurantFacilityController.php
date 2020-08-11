<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant\RestaurantBasicInfo;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Restaurant\RestaurantFacility;

class RestaurantFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        //
        $user = Auth::user();

        // Get the currently authenticated user's ID...
        $id = Auth::id();
        return $id;
        // return response()->json(array('response' => 'success', 'status' => $user));

        // return "Restaurant facilities";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $facilities = RestaurantFacility::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        // fetch ID
        $facilities = RestaurantFacility::find($id);
        // udpate function
        $facilities->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 
     * Custom 
     * API
     *  */
    public function facility(RestaurantBasicInfo $restaurantBasicInfo){
        return $restaurantBasicInfo->restaurant_facilities()->get(); 

    } 
}
