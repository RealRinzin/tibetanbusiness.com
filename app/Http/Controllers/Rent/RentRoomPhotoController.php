<?php

namespace App\Http\Controllers\Rent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rent\RentBasicInfo;
use App\Rent\RentRoomPhoto;
use Illuminate\Support\Facades\Auth;

class RentRoomPhotoController extends Controller
{
    protected $path = '../public/storage/Rent/Room-Photos/';

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $countPhotos = count($_FILES['images']['name']);
        // Looping the files
        for ($i = 0; $i < $countPhotos; $i++) {
            // File Loop
            $file_name = $_FILES['images']["tmp_name"][$i];
            // image extension extraction
            $extension = explode("/", $_FILES["images"]["type"][$i]);
            $name = time() .$i .'.' . $extension[1];
            $thumb = time() . $i.'-thumb.' . $extension[1];
            // Original
            \Image::make($file_name)->save($this->path. $name);
            $Original =  \Image::make($file_name)->save($this->path. $name);
            // card
            $Original->resize(220, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save($this->path. $thumb);
            // Inserting
            // Recording in Database
            $restaurant = RentRoomPhoto::create([
                'rent_basic_info_id' => $request->id,
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
        $photos = RentRoomPhoto::find($id);
        // Delete
        $unlink = $this->path. $photos->path;
        $thumb = $this->path. $photos->thumb;
        // Unlinking all the photos
        unlink($unlink);
        unlink($thumb);
        $photos->delete();
    }
    /**
     *Photos 
     */
    public function photos(RentBasicInfo $rentBasicInfo)
    {
        return $rentBasicInfo->rent_room_photos()->orderBy('created_at', 'desc')->get();
    }
}
