<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant\RestaurantMenuPhoto;
use Illuminate\Support\Facades\Auth;

class RestaurantMenuPhotoController extends Controller
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
                $restaurant = RestaurantMenuPhoto::create([
                    'restaurant_basic_info_id' => $request->id,
                    'path' => $image->store(''),
                    'user_id' => Auth::user()->id,
                ]);
                // $image->store('public\images');
                $image->store('\public\Restaurant\Menu-Pictures');

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
        $photos = RestaurantMenuPhoto::find($id);
        $photos->delete();
        // Deleting the file too
        // if ($photos->path) {
        //     unlink('storage/Restaurant/Menu-Pictures' . $photos->path);
        // }
        // unlink('img/'.$photos->path);
        // return $photos;
    }
}
