<?php

namespace App\Http\Controllers\Rent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rent\RentBasicInfo;
use App\Rent\RentFacility;
use App\Restaurant\RestaurantBasicInfo;

class RentFacilityController extends Controller
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
        $facilities = RentFacility::create($request->all());

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
        $facilities = $request[0];
        // return $facilities;
        $facilities = RentFacility::find($id);
        // return $facilities;
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
    public function facility(RentBasicInfo $rentBasicInfo)
    {
        return $rentBasicInfo->rent_facilities()->get(); 

    }
}
