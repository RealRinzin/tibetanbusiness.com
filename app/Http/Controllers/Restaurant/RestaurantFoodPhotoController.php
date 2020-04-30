<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant\RestaurantFoodPhoto;
use Illuminate\Support\Facades\Auth;

class RestaurantFoodPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return "Restaurant Food Photos";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // if (count($request->images)) {
        //     foreach ($request->images as $image) {
        //         $restaurant = RestaurantFoodPhoto::create([
        //             'restaurant_basic_info_id' => 'rinzintestin',
        //             'path' => $image->store(''),
        //             'user_id' => Auth::user()->id,
        //         ]);
        //         $image->store('public\images');
        //     }
        // }
        // return $restaurant;

        // return response()->json([
        //     "message" => "Done"
        // ]);
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
}
