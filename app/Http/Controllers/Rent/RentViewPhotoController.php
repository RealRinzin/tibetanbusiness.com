<?php

namespace App\Http\Controllers\Rent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rent\RentBasicInfo;
use App\Rent\RentViewPhoto;
use Illuminate\Support\Facades\Auth;

class RentViewPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Counting the photos
        $countPhotos = count($_FILES['images']['name']);
        // Looping the files
        for ($i = 0; $i < $countPhotos; $i++) {
            // File Loop
            $file_name = $_FILES['images']["tmp_name"][$i];
            // image extension extraction
            $extension = explode("/", $_FILES["images"]["type"][$i]);
            $name = time() . '.' . $extension[1];
            $card = time() . '-card.' . $extension[1];
            $thumb = time() . '-thumb.' . $extension[1];
            // Original
            \Image::make($file_name)->save(public_path('/storage/Rent/View-Photos/') . $name);
            $Original =  \Image::make($file_name)->save(public_path('/storage/Rent/View-Photos/') . $name);
            // card
            $Original->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Rent/View-Photos/') . $card);
            // thumb
            $Original->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Rent/View-Photos/') . $thumb);
            // Inserting
            // Recording in Database
            $restaurant = RentViewPhoto::create([
                'rent_basic_info_id' => $request->id,
                'path' => $name,
                'card' => $card,
                'thumb' => $thumb,
                'user_id' => Auth::user()->id,
            ]);
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
        //
        $photos = RentViewPhoto::find($id);
        $unlink = public_path() . '/storage/Rent/View-Photos/' . $photos->path;
        $card = public_path() . '/storage/Rent/View-Photos/' . $photos->card;
        $thumb = public_path() . '/storage/Rent/View-Photos/' . $photos->thumb;
        // Unlinking all the photos
        unlink($unlink);
        unlink($card);
        unlink($thumb);
        $photos->delete();
    }
    /**
     *Photos 
     */
    public function photos(RentBasicInfo $rentBasicInfo)
    {
        return $rentBasicInfo->rent_view_photos()->orderBy('created_at', 'desc')->get();
    }
}
