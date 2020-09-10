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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $facilities = RestaurantFacility::create($request->all());
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
     * 
     * Custom 
     * API
     *  */
    public function facility(RestaurantBasicInfo $restaurantBasicInfo){
        return $restaurantBasicInfo->restaurant_facilities()->get(); 

    } 
}
