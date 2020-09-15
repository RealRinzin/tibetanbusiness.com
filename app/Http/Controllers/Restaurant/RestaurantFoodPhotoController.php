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
        // Counting the photos
        $countPhotos = count($_FILES['images']['name']);
        // Looping the files
        for ($i = 0; $i < $countPhotos; $i++) {
            // File Loop
            $file_name = $_FILES['images']["tmp_name"][$i];
            // image extension extraction
            $extension = explode("/", $_FILES["images"]["type"][$i]);
            $name = time() .$i. '.' . $extension[1];
            $thumb = time() .$i. '-thumb.' . $extension[1];
            // Original
            \Image::make($file_name)->save(public_path('/storage/Restaurant/Food-Pictures/') . $name);
            $Original =  \Image::make($file_name)->save(public_path('/storage/Restaurant/Food-Pictures/') . $name);
            // thumb
            $Original->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Restaurant/Food-Pictures/') . $thumb);
            // Inserting
            // Recording in Database
            $restaurant = RestaurantFoodPhoto::create([
                'restaurant_basic_info_id' => $request->id,
                'path' => $name,
                'thumb' => $thumb,
                'user_id' => Auth::user()->id,
            ]);
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
        // Delete
        $unlink = public_path() . '/storage/Restaurant/Food-Pictures/' . $photos->path;
        $thumb = public_path() . '/storage/Restaurant/Food-Pictures/' . $photos->thumb;
        // Unlinking all the photos
        unlink($unlink);
        unlink($thumb);
        $photos->delete();

    }

    /**
     *Photos 
     */
    public function photos(RestaurantBasicInfo $restaurantBasicInfo){
        return $restaurantBasicInfo->restaurant_food_photos()->orderBy('created_at', 'desc')->get(); 
    }
}
