<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant\RestaurantBasicInfo;
use App\Restaurant\RestaurantFoodPhoto;
use Illuminate\Support\Facades\Auth;

class RestaurantFoodPhotoController extends Controller
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
        if (count($request->images)) {
            foreach ($request->images as $image) {
                $restaurant = RestaurantFoodPhoto::create([
                    'restaurant_basic_info_id' => $request->id,
                    'path' => $image->store(''),
                    'user_id' => Auth::user()->id,
                ]);
                // $image->store('public\images');
                $image->store('public\Restaurant\Food-Pictures');
            }
        }
        return response()->json([
            "message" => "Done"
        ]);
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
        $photos = RestaurantFoodPhoto::find($id);
        $photos->delete();
        // Deleting the file too
        if($photos->path){
            unlink('img/' . $photos->path);
        }
    }

    /**
     *Photos 
     */
    public function photos(RestaurantBasicInfo $restaurantBasicInfo){
        return $restaurantBasicInfo->restaurant_food_photos()->orderBy('created_at', 'desc')->get(); 
    }
}
