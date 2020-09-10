<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant\RestaurantBasicInfo;
use App\Restaurant\RestaurantOperationDay;
use Illuminate\Support\Facades\DB;


class RestaurantOperationDayController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $operation_days = RestaurantOperationDay::create($request->all());

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
        // fetch ID
        $restaurantOperationDay = RestaurantOperationDay::find($id);
        // udpate function
        $restaurantOperationDay->update($request->all());
    }
    /**
     * 
     * Custom 
     * API
     *  */
    public function operation(RestaurantBasicInfo $restaurantBasicInfo)
    {
        return $restaurantBasicInfo->restaurant_operation_days()->get();
    } 
}
